<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

trait UploadTrait {
	public function storeUploadedFile(UploadedFile $uploadedFile, string $disk = 'public', string $folder = null, string $fileName = null) {
		$name = !is_null($fileName) ? $fileName : Str::random(16);
		$name = $name.'.'.$uploadedFile->getClientOriginalExtension();
		return $uploadedFile->storePubliclyAs($folder, $name, $disk);
	}
}
