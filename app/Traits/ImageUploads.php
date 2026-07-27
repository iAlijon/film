<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageUploads
{
    public function uploads($image, $folder, $width_ratio, $height_ratio)
    {
//        $app_url = config('app.url');
        $dir_name = 'public/'.$folder;
        $file_name = time().'_'.$image->getClientOriginalName();
        $file_name = str_replace(' ', '_', $file_name);
        $path = $dir_name."/".$file_name;
        $ratioWidth = (int) $width_ratio;
        $ratioHeight = (int) $height_ratio;
        $targetRatio = $ratioWidth / $ratioHeight;

        $img = Image::make($image);
        $originalWidth = $img->width();
        $originalHeight = $img->height();
        $currentRatio = $originalWidth / $originalHeight;

        if ($currentRatio > $targetRatio) {
            $newWidth = (int) round($originalHeight * $targetRatio);
            $img->crop($newWidth, $originalHeight);
        } elseif ($currentRatio < $targetRatio) {
            $newHeight = (int) round($originalWidth / $targetRatio);
            $img->crop($originalWidth, $newHeight);
        }
        $encodedImage = (string) $img->encode();

        if (Storage::put($path, $encodedImage)) {
            return '/storage/'.$folder.'/'.$file_name;
        }else{
            return null;
        }
    }

    public function fileUploads($file, $folder)
    {
//        $app_url = config('app.url');
        $file_name = time().'_'.$file->getClientOriginalName();
        $file_name = str_replace(' ', '_', $file_name);
        $path = public_path('files/').$folder;
        if ($file->move($path, $file_name)){
            return '/files/'.$folder.'/'.$file_name;
        }else{
            return null;
        }
    }

    public function video($video)
    {
        $extension = $video->getClientOriginalExtension();
        $full_name = uniqid('video_', true) . '.' . $extension;

        $path = public_path('file/video');

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        if ($video->move($path, $full_name)) {
            return 'file/video/' . $full_name;
        }

        return null;
    }
}
