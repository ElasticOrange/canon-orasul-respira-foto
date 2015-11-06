<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use App\Vote;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    //

    public function getIndex($profileId)
    {
        $profile = Profile::where("id","=",$profileId)->first();

        if ($profile && $profile->isActive==1){
            session(['profileId' => $profileId]);

            $vote = Vote::where(['user_id' => Auth::id(), 'profile_id' => $profileId])->first();
            $voted = false;
            if (!$vote || $vote->isActive==1){
                $voted = true;
            }

            $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

            $user = User::where("id","=",$profile->user_id)->first();
            $data = array(
                'selectedPage' => -1,
                'profile' => $profile,
                'user' => $user,
                'fbLink' => $fb->getLoginUrl(['email']),
                'votes' => $profile->votes()->where('isActive', '1')->get(),
                'voted' => $voted
            );
            return view('profile.index',$data);
        }
        else{
            echo "profile not found";
        }
    }

    public function getClasament()
    {

        $votes = Vote::select(DB::raw('votes.*, count(*) as `voteCount`'))
            ->groupBy('profile_id')
            ->orderBy('voteCount', 'desc')
            ->get();

        $data = array(
            'selectedPage' => 1,
            'votes' => $votes
        );
        return view('profile.clasament',$data);
    }

    public function postSubmitVote(Request $request)
    {
        if (!Auth::id()){
            return response()->json([
                    'message' => 'user not found'
                ],
                400
            );
        }

        $profile = Profile::where("id","=",$request->input("profileId"))->first();
        if (!$profile || $profile->isActive!=1){
            return response()->json([
                    'message' => 'profile not found'
                ],
                400
            );
        }

        $vote = Vote::where(['user_id' => Auth::id(), 'profile_id' =>$request->input("profileId")])->first();
        if (!$vote || $vote->isActive==1){
            return response()->json([
                    'message' => 'cannot change vote'
                ],
                400
            );
        }

        $vote->isActive = 1;
        $vote->save();

        return response()->json([
                'message' => 'validEntry'
            ],
            201
        );
    }

}
