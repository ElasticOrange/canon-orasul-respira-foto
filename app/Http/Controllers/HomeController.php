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

		return view('home.index', $data);
	}
}
