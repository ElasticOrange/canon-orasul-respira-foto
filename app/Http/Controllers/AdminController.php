<?php

namespace App\Http\Controllers;

use App\Profile;

class AdminController extends Controller
{
    public function getIndex()
    {
        $profiles = Profile::where('checked', 0)->get();

        return view('admin/index', ['profiles' => $profiles]);
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
}
