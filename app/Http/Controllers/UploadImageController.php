<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Image;

use ImageIntervention;

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
		if (!$image_file) {
			return response()->json([
					'message' => 'resource not found'
				],
				400
			);
		}

		$image = Image::create();

		$image_file->move(storage_path(), md5($image->id));

		$img = ImageIntervention::make(storage_path() .'/'. md5($image->id));
		$img->resize(1000, 1000, function ($constraint){
			$constraint->aspectRatio();
			$constraint->upsize();
		});
		$img->save(storage_path() .'/'. md5($image->id), 100);

		$image->path = md5($image->id);
		$image->save();

		$request->session()->push('uploaded_images', $image->id);

		return response()->json([
				'message' => 'created'
				, 'session' => $request->session()->get('uploaded_images')
			],
			201
		);
	}
}
