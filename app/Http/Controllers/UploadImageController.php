<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Image;

class UploadImageController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function postIndex(Request $request)
	{
		$image_file = $request->file('image');

		$image = Image::create();

		$image_file->move(storage_path(), md5($image->id));
		$image->path = md5($image->id);
		$image->save();

		$request->session()->push('uploaded_images', $image->id);

		return response()->json([
				'message' => 'created'
				, 'session' => $request->session()->get('uploaded_images')
			]
			, 201
		);
	}
}
