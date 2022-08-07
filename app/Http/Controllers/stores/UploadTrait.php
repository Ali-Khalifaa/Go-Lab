<?php
namespace App\Http\Controllers\stores;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{

    // upload an image

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(15);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }
}
