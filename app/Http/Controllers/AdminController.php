<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Vote;
use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth', ['except' => ['getLogin', 'postLogin', 'getLogout']]);
    }

    public function getIndex()
    {
        $profiles = Profile::where('checked', 0)->where('isActive', 1)->get();

        return view(
            'admin/index',
            [
                'profiles' => $profiles,
                'total_active_profiles' => Profile::where('isActive', 1)->count(),
                'total_active_votes' => Vote::where('isActive', 1)->count(),
            ]
        );
    }

    public function getDisapproveProfile($profileId)
    {
        $profile = Profile::find($profileId);

        $profile->checked = 1;
        $profile->isActive = 0;
        $profile->save();

        return redirect('admin/index');
    }

    public function getApproveProfile($profileId)
    {
        $profile = Profile::find($profileId);

        $profile->checked = 1;
        $profile->isActive = 1;
        $profile->save();

        return redirect('admin/index');
    }

    public function getVotes()
    {
        $votes = Vote::where('checked', 0)->where('isActive', 1)->get();

        return view('admin/votes', ['votes' => $votes]);
    }

    public function getDisapproveVote($voteId)
    {
        $vote = Vote::find($voteId);

        $vote->checked = 1;
        $vote->isActive = 0;
        $vote->save();

        return redirect('admin/votes');
    }

    public function getApproveVote($voteId)
    {
        $vote = Vote::find($voteId);

        $vote->checked = 1;
        $vote->isActive = 1;
        $vote->save();

        return redirect('admin/votes');
    }

    public function getLogin()
    {
        return view('admin/login');
    }

    public function postLogin(Request $request)
    {
        $user = $request->input('email');
        $pass = $request->input('password');

        if (Admin::login($user, $pass)) {
            return redirect('admin/index');
        } else {
            return redirect()->back();
        }
    }

    public function getLogout()
    {
        Admin::logout();

        return redirect()->back();
    }
}
