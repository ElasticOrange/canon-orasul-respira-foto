<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    //

    public function getIndex()
    {
        $data = array(
            'selectedPage' => 2
        );
        return view('register.index',$data);
    }

    public function getThankYou()
    {
        echo 'will log you out';
        echo Auth::logout();
    }    
}
