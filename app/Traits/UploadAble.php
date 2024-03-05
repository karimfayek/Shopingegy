<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
/**
 * Trait UploadAble
 * @package App\Traits
 */
trait UploadAble
{
    /**
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        $extension = $file->getClientOriginalExtension();
        $filenameWithExtension = $name . "." . $extension;
        $path = $file->storeAs($folder, $filenameWithExtension, $disk);

        // Convert to WebP and save if supported
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $image = Image::make($file->getRealPath());
            $webpFilename = $name . '.webp';
            $image->encode('webp')->save(public_path("storage/{$folder}/{$webpFilename}"));
       
            $path = $folder . '/' . $webpFilename;
        }


        return $path;
    }

    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteOne($path = null, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}
