<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait FileUploaderTrait
{

    public function uploadFile(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : time();
        $path = !is_null($folder) ? $folder  : '';

        return $file->storeAs($path, $name . '.' . $file->getClientOriginalExtension(), $disk);
    }

    // // Upload avatar and use Intervention Image to resize it
    // public function uploadAvatar($file, $folder = null, $disk = 'public', $filename = null)
    // {
    //     $name = !is_null($filename) ? $filename : time();
    //     $path = !is_null($folder) ? $folder . '/' : '';
    //     // $img = Image::make($file)->resize(300, 300)->encode('jpg', 80);
    //     Storage::disk($disk)->put($path . $name . '.jpg', $file);
    //     return $path . $name . '.jpg';
    // }
    // public function uploadFile($file, $folder = null, $disk = 'public', $filename = null)
    // {
    //     $name = !is_null($filename) ? $filename : time();
    //     $path = !is_null($folder) ? $folder . '/' : '';
    //     return $file->storeAs($path, $name . '.' . $file->getClientOriginalExtension(), $disk);
    // }

    public function deleteFile($file, $disk = 'public')
    {
        if (Storage::disk($disk)->exists($file)) {
            return Storage::disk($disk)->delete($file);
        } else throw new \Exception('File does not exist', 404);
    }

    public function deleteFiles($files, $disk = 'public')
    {
        foreach ($files as $file) {
            $this->deleteFile($file, $disk);
        }
        return true;
    }

    public function updateFile($oldFile, $newFile, $folder = null, $disk = 'public', $filename = null)
    {
        $this->deleteFile($oldFile, $disk);
        return $this->uploadFile($newFile, $folder, $disk, $filename);
    }

    public function uploadMultipleFiles($files, $folder = null, $disk = 'public')
    {
        $fileNames = [];
        foreach ($files as $file) {
            $fileNames[] = $this->uploadFile($file, $folder, $disk);
        }
        return $fileNames;
    }

    public function deleteMultipleFiles($files, $disk = 'public')
    {
        foreach ($files as $file) {
            $this->deleteFile($file, $disk);
        }
        return true;
    }

    public function updateMultipleFiles($oldFiles, $newFiles, $folder = null, $disk = 'public')
    {
        $this->deleteMultipleFiles($oldFiles, $disk);
        return $this->uploadMultipleFiles($newFiles, $folder, $disk);
    }

    public function uploadBase64File($file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : time();
        $path = !is_null($folder) ? $folder . '/' : '';
        $file = str_replace('data:image/png;base64,', '', $file);
        $file = str_replace(' ', '+', $file);
        $name = $name . '.' . 'png';
        Storage::disk($disk)->put($path . $name, base64_decode($file));
        return $path . $name;
    }
}
