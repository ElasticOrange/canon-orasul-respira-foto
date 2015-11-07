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
        $profile = Profile::where("user_id","=",Auth::id())->first();
        if ($profile && $profile->isActive==1){
            return redirect('/profile/index/'.$profile->id);
        }

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

        $data = array(
            'selectedPage' => 2,
            'profile' => Profile::where("user_id","=",Auth::id())->first(),
            'user' => Auth::user(),
            'redirectUrl' => shortenUrl( URL::to('/profile/index/'.$profile->id) ),
            'pageUrl' => URL::to('/profile/index/'.$profile->id)
        );
        return view('register.preview',$data);
    }    
}
