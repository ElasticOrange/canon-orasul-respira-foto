<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\User;
use App\Vote;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    private $pictures_lazy_load = 50;

    public function postIndex($profileId)
    {
        return $this->getIndex($profileId);
    }

    public function getIndex($profileId)
    {
        $profile = Profile::where('id', '=', $profileId)->first();

        if ($profile && $profile->isActive == 1) {
            session(['profileId' => $profileId]);

            $vote = Vote::where(['user_id' => Auth::id(), 'profile_id' => $profileId])->first();
            $voted = false;
            if ($vote && $vote->isActive == 1) {
                $voted = true;
            }

            $photos = [];
            if ($profile->photo1 != '') {
                $photos[] = $profile->photo1;
            }
            if ($profile->photo2 != '') {
                $photos[] = $profile->photo2;
            }
            if ($profile->photo3 != '') {
                $photos[] = $profile->photo3;
            }
            if ($profile->photo4 != '') {
                $photos[] = $profile->photo4;
            }
            if ($profile->photo5 != '') {
                $photos[] = $profile->photo5;
            }

            $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

            $user = User::where('id', '=', $profile->user_id)->first();
            $data = array(
                'selectedPage' => 1,
                'profile' => $profile,
                'user' => $user,
                'fbLink' => $fb->getLoginUrl(['email']),
                'votes' => $profile->votes()->where('isActive', '1')->paginate($this->pictures_lazy_load),
                'total_votes' => $profile->votes()->where('isActive', '1')->count(),
                'voted' => $voted,
                'photos' => $photos,
                'pageUrl' => env('BASE_FB_URL').'profile/index/'.$profile->id,
            );

            return view('profile.index', $data);
        } else {
            echo 'profile not found';
        }
    }

    public function getPicturesLazyLoad($profileId)
    {
        $profile = Profile::where('id', '=', $profileId)->first();

        if ($profile && $profile->isActive == 1) {
            $votes = $profile->votes()->where('isActive', '1')->take(50)->get();
        } else {
            echo 'profile not found';
        }
    }

    public function getClasament()
    {
        $profiles = Profile::select(DB::raw('*,(select count(*) from votes where profile_id=profiles.id and isActive=1) as voteCount'))
            ->where('isActive', '=', '1')
            ->orderBy('voteCount', 'desc')
            ->paginate(20);

        $data = array(
            'selectedPage' => 1,
            'profiles' => $profiles,
        );

        return view('profile.clasament', $data);
    }

    public function postSubmitVote(Request $request)
    {
        return redirect()->action('HomeController@getGameOver');

        if (!Auth::id()) {
            return response()->json(
                [
                    'message' => 'user not found',
                ],
                400
            );
        }

        $profile = Profile::where('id', '=', $request->input('profileId'))->first();
        if (!$profile || $profile->isActive != 1) {
            return response()->json(
                [
                    'message' => 'profile not found',
                ],
                400
            );
        }

        $vote = Vote::where(['user_id' => Auth::id(), 'profile_id' => $request->input('profileId')])->first();
        if (!$vote || $vote->isActive == 1) {
            return response()->json(
                [
                    'message' => 'cannot change vote',
                ],
                400
            );
        }

        $vote->isActive = 1;
        $vote->save();

        return response()->json(
            [
                'message' => 'validEntry',
            ],
            201
        );
    }
}
