<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Image;
use Illuminate\Support\Facades\Storage;

use ImageIntervention;
use App\Profile;
use App\Vote;

class UploadImageController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function postIndex(Request $request)
	{
        if (!Auth::id()){
            return response()->json([
                    'message' => 'user not found'
                ],
                400
            );
        }

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
		$img->save( base_path() . '/public/images/'. md5($image->id).'.jpg', 100);

        $img = ImageIntervention::make(storage_path() .'/'. md5($image->id));
        $img->fit(80, 80);
        $img->save( base_path() . '/public/images/thumb_80_'. md5($image->id).'.jpg', 100);

        $img = ImageIntervention::make(storage_path() .'/'. md5($image->id));
        $img->fit(180, 135);
        $img->save( base_path() . '/public/images/thumb_180_'. md5($image->id).'.jpg', 100);

        $profile = Profile::firstOrCreate(['user_id' => Auth::id()]);
        $profile->user_id=Auth::id();

        switch($request->input("imageId")){
            case 1 :
                $profile->photo1 = md5($image->id);
            break;
            case 2 :
                $profile->photo2 = md5($image->id);
                break;
            case 3 :
                $profile->photo3 = md5($image->id);
                break;
            case 4 :
                $profile->photo4 = md5($image->id);
                break;
            case 5 :
                $profile->photo5 = md5($image->id);
                break;
        }

        $profile->save();

        //$request->session()->push('uploaded_images', $image->id);

		return response()->json([
				'message' => 'created',
				'path' => '/images/thumb_80_'. md5($image->id).'.jpg',
                'imageId' => $request->input("imageId")
			],
			201
		);
	}

    public function postVote(Request $request)
    {
        if (!Auth::id()){
            return response()->json([
                    'message' => 'user not found'
                ],
                400
            );
        }

        $profile = Profile::where("id","=",$request->input("profileId"))->first();
        if (!$profile || $profile->isActive!=1){
            return response()->json([
                    'message' => 'profile not found'
                ],
                400
            );
        }

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
        $img->save( base_path() . '/public/images/votes/'. md5($image->id).'.jpg', 100);

        $img = ImageIntervention::make(storage_path() .'/'. md5($image->id));
        $img->fit(80, 80);
        $img->save( base_path() . '/public/images/votes/thumb_80_'. md5($image->id).'.jpg', 100);

        $img = ImageIntervention::make(storage_path() .'/'. md5($image->id));
        $img->fit(132, 99);
        $img->save( base_path() . '/public/images/votes/thumb_132_'. md5($image->id).'.jpg', 100);

        $vote = Vote::firstOrCreate(['user_id' => Auth::id(), 'profile_id' =>$request->input("profileId")]);
        $vote->user_id=Auth::id();
        $vote->profile_id=$request->input("profileId");
        $vote->photo = md5($image->id);

        $vote->save();

        //$request->session()->push('uploaded_images', $image->id);

        return response()->json([
                'message' => 'created',
                'path' => '/images/votes/thumb_80_'. md5($image->id).'.jpg',
                'imageId' => $request->input("imageId")
            ],
            201
        );
    }


    public function postRemove(Request $request)
    {
        if (!Auth::id()){
            return response()->json([
                    'message' => 'user not found'
                ],
                400
            );
        }

        $imageId = $request->input("imageId");
        if ($imageId<1 || $imageId>5) {
            return response()->json([
                    'message' => 'resource not found'
                ],
                400
            );
        }

        $profile = Profile::firstOrCreate(['user_id' => Auth::id()]);
        $profile->user_id=Auth::id();

        switch($request->input("imageId")){
            case 1 :
                unlink (public_path() .generatePhotoURL('full',$profile->photo1));
                unlink (public_path() .generatePhotoURL('thumb_80',$profile->photo1));
                unlink (public_path() .generatePhotoURL('thumb_180',$profile->photo1));
                $profile->photo1 = '';
                break;
            case 2 :
                unlink (public_path() .generatePhotoURL('full',$profile->photo2));
                unlink (public_path() .generatePhotoURL('thumb_80',$profile->photo2));
                unlink (public_path() .generatePhotoURL('thumb_180',$profile->photo2));
                $profile->photo2 = '';
                break;
            case 3 :
                unlink (public_path() .generatePhotoURL('full',$profile->photo3));
                unlink (public_path() .generatePhotoURL('thumb_80',$profile->photo3));
                unlink (public_path() .generatePhotoURL('thumb_180',$profile->photo3));
                $profile->photo3 = '';
                break;
            case 4 :
                unlink (public_path() .generatePhotoURL('full',$profile->photo4));
                unlink (public_path() .generatePhotoURL('thumb_80',$profile->photo4));
                unlink (public_path() .generatePhotoURL('thumb_180',$profile->photo4));
                $profile->photo4 = '';
                break;
            case 5 :
                unlink (public_path() .generatePhotoURL('full',$profile->photo5));
                unlink (public_path() .generatePhotoURL('thumb_80',$profile->photo5));
                unlink (public_path() .generatePhotoURL('thumb_180',$profile->photo5));
                $profile->photo5 = '';
                break;
        }

        $profile->save();

        //$request->session()->push('uploaded_images', $image->id);

        return response()->json([
                'message' => 'removed',
                'imageId' => $imageId
            ],
            201
        );
    }

    public function postRemoveVote(Request $request)
    {
        if (!Auth::id()){
            return response()->json([
                    'message' => 'user not found'
                ],
                400
            );
        }

        $profile = Profile::where("id","=",$request->input("profileId"))->first();
        if (!$profile || $profile->isActive!=1){
            return response()->json([
                    'message' => 'profile not found'
                ],
                400
            );
        }

        $vote = Vote::where(['user_id' => Auth::id(), 'profile_id' =>$request->input("profileId")])->first();
        if (!$vote || $vote->isActive==1){
            return response()->json([
                    'message' => 'cannot change vote'
                ],
                400
            );
        }

        unlink (public_path() .generatePhotoURL('full',$vote->photo,true));
        unlink (public_path() .generatePhotoURL('thumb_80',$vote->photo,true));
        unlink (public_path() .generatePhotoURL('thumb_132',$vote->photo,true));
        $profile->photo = '';

        $vote->save();

        return response()->json([
                'message' => 'removed',
            ],
            201
        );
    }
}
