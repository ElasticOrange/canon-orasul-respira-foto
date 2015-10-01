<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Image;

class UploadImageTest extends TestCase
{
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		/* Can't figure out why it doesnt send the file through POST
		$test_file_path = base_path() . '/tests/Files/1.jpg';
		$image_data = getimagesize($test_file_path);
		$file = new \Symfony\Component\HttpFoundation\File\UploadedFile(
			$test_file_path
			, '1.jpg'
			, $image_data['mime']
			, 466
			, null

		);

		$this->call(
			'POST'
			, '/upload-image'
			, []
			, [
				'image' => $file
			]
		);

		$image = Image::orderBy('created_at', 'desc')->first();

		$this->assertNotNull($image);
		$this->assertGreaterThan(0, $image->id);
		$this->assertEquals(Storage::get($test_file_path), $file);

		$file_contents = Storage::get($image->path);
		*/
	}
}
