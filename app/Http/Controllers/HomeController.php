<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data = array('selectedPage' => 0);

        return view('home.index', $data);
    }

    public function postIndex()
    {
        $data = array('selectedPage' => 0);

        if (count($_COOKIE) === 0) {
            return '<script>top.location = "https://canon-pwp.elasticorange.com/cookiefix";</script>';
        }

        return view('home.index', $data);
    }

    public function getCookiefix()
    {
        return '<script>top.location = "https://www.facebook.com/canonromania/app/1059827974029585/";</script>';
    }
}
