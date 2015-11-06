<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use ImageIntervention;

class FacebookController extends Controller
{
    //
    public function getLogin()
    {
        Session::forget('profileId');
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        $data = array(
            'selectedPage' => 2 ,
            'fbLink' => $fb->getLoginUrl(['email'])
        );
        return view('register.fblogin',$data);
    }
 
    public function getCallback()
    {
        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        // Obtain an access token.
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.
        if (! $token) {
            // Get the redirect helper
            $helper = $fb->getRedirectLoginHelper();

            if (! $helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
        }

        if (! $token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = $fb->getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

        // Save for later
        Session::put('fb_user_access_token', (string) $token);

        // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('/me?fields=id,name,email,picture.type(large)');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebook_user = $response->getGraphUser();

        // Create the user if it does not exist or update the existing entry.
        // This will only work if you've added the SyncableGraphNodeTrait to your User model.
        $user = User::createOrUpdateGraphNode($facebook_user);

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $img = ImageIntervention::make(file_get_contents($user->url, false, stream_context_create($arrContextOptions)));
        $img->fit(100);
        $img->save( base_path() . '/public/images/profilePhotos/thumb_100_'. md5($user->id).'.jpg', 100);

        $img = ImageIntervention::make(file_get_contents($user->url, false, stream_context_create($arrContextOptions)));
        $img->fit(50);
        $img->save( base_path() . '/public/images/profilePhotos/thumb_50_'. md5($user->id).'.jpg', 100);

        // Log the user into Laravel
        Auth::login($user);

        //maybe this need to redirect back to the originating page
        if (Session::has('profileId'))
        {
            return redirect('/profile/index/'.Session::get('profileId'));
        }
        else{
            return redirect('/register');
        }
    }
}
