<?php

namespace App\Http\Controllers;

use App\Profile;

class AdminController extends Controller
{
    public function getIndex()
    {
        $profiles = Profile::all();

        return view('admin/index', ['profiles' => $profiles]);
    }
}
