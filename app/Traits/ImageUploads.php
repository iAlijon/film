<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageUploads
{
    public function uploads($image, $folder)
    {
        $app_url = config('app.url');
        $dir_name = 'public/'.$folder;
        $file_name = time().'_'.$image->getClientOriginalName();
        $path = $dir_name."/".$file_name;
        if (Storage::put($path, file_get_contents($image))) {
            return $app_url.'/storage/'.$folder.'/'.$file_name;
        }else{
            return null;
        }
    }

    public function fileUploads($file, $folder)
    {
        $file_name = time().'_'.$file->getClientOriginalName();
        $path = public_path('files/').$folder;
        if ($file->move($path, $file_name)){
            return $file_name;
        }else{
            return null;
        }
    }
}
