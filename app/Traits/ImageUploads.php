<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;

trait ImageUploads
{
    public function uploads($image, $folder)
    {
        $app_url = config('app.url');
        $dir_name = 'public/'.$folder;
        $file_name = time().'_'.$image->getClientOriginalName();
        $path = $dir_name."/".$file_name;
        if (Storage::put($path, file_get_contents($image)))
        {
            return $app_url.'/storage/'.$folder.'/'.$file_name;
        }else{
            return null;
        }
    }
}
