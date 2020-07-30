<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadFile(UploadedFile $uploadedFile, $folder = null, $disk = 'public')
    {
    	// Make a file path where image will be stored [ folder path + file name + '_' +current timestamp + file extension]
        $filenameWithExtension = $uploadedFile->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $uploadedFile->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Upload Image
        $file = $uploadedFile->storeAs($folder, $fileNameToStore, $disk);

        return $file;
    }
}