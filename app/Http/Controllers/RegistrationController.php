<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    //

    public function getImages()
    {
    	return view('register.images');
    }
 
    public function getPersonalData()
    {
    	return "pesonalData";
    }

	public function getThankYou()
    {
    	return "thx";
    }    
}
