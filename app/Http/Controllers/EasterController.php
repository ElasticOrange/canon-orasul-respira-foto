<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EasterController extends Controller
{
    public function getIndex()
    {
        return view('easter.index');
    }

    public function postIndex()
    {
        return view('easter.index');
    }
}
