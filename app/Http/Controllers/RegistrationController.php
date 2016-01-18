<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Support\Facades\URL;

class RegistrationController extends Controller
{
    //

    public function getIndex()
    {
        $profile = Profile::firstOrCreate(['user_id' => Auth::id()]);

        if ($profile && $profile->isActive==1){
            return redirect('/profile/index/'.$profile->id);
        }

        return redirect()->action('HomeController@getGameOver');

        if ($profile->shortLink==""){
            $profile->user_id = Auth::id();
            $profile->shortLink = shortenUrl( $_ENV['BASE_FB_URL'].'profile/index/'.$profile->id );
        }

        $profile->save();

        $data = array(
            'selectedPage' => 2
        );
        return view('register.index',$data);
    }

    public function postSaveInfo(){

        $user = Auth::user();
        $user->tel = Input::get('phone');
        $user->save();

        $profile = Profile::where("user_id","=",Auth::id())->first();
        $profile->description = Input::get('description');
        $profile->save();

        return redirect("/register/preview");
    }

    public function postSubmitEntry(Request $request)
    {
        return redirect()->action('HomeController@getGameOver');

        if (!Auth::id()){
            return response()->json([
                    'message' => 'user not found'
                ],
                400
            );
        }

        $profile = Profile::where("user_id","=",Auth::id())->first();
        $profile->description =  $request->input('description');
        $profile->isActive = 1;
        $profile->save();

        return response()->json([
                'message' => 'validEntry',
                'desc' => $request->input('description')
            ],
            201
        );
    }

    public function getPreview()
    {
        $profile = Profile::where("user_id","=",Auth::id())->first();
        if (!$profile){
            return redirect('/register');
        }
        else if ($profile->isActive==1){
            return redirect('/profile/index/'.$profile->id);
        }

        $photos = [];
        if ($profile->photo1!="") $photos[]=$profile->photo1;
        if ($profile->photo2!="") $photos[]=$profile->photo2;
        if ($profile->photo3!="") $photos[]=$profile->photo3;
        if ($profile->photo4!="") $photos[]=$profile->photo4;
        if ($profile->photo5!="") $photos[]=$profile->photo5;

        $data = array(
            'selectedPage' => 2,
            'profile' => Profile::where("user_id","=",Auth::id())->first(),
            'user' => Auth::user(),
            'pageUrl' =>$_ENV['BASE_FB_URL'].'profile/index/'.$profile->id,
            'photos' => $photos
        );
        return view('register.preview',$data);
    }
}
