<?php

use Illuminate\Support\Str;

if (!function_exists('contentByDomDocment')) {
    function contentByDomDocment($content, $folder)
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $content = str_replace("\0", '', $content);
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        //Images
        $images = $dom->getElementsByTagName('img');
        if (count($images) > 0) {
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                $isData = preg_match('/\bdata:image\b/', $data);
                if ($isData) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);

                    $directory = "/uploads/images/" . $folder . "/";
                    $path = public_path() . $directory;
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }

                    $file_name = Str::random(10) . $k . '.jpg';
                    $file_path = $directory . $file_name;
                    file_put_contents($path . $file_name, $data);
                } else {
                    $file_path = $data;
                }
                $img->removeAttribute('src');
                $img->setAttribute('src', $file_path);
            }
        }

        //Files
        $links = $dom->getElementsByTagName('a');
        if (count($links) > 0) {
            foreach ($links as $k => $link) {
                $dataFile = $link->getAttribute('href');
                if (preg_match('/\bblob:\b/', $dataFile)) {
                    list($url, $dataFile) = explode('/9fformat', $dataFile);
                    list($file_format, $dataFile) = explode('/bs64file', $dataFile);
                    switch ($file_format) {
                        case "application/vnd.ms-excel" :
                            $file_type = '.xls';
                            break;
                        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                            $file_type = '.xlsx';
                            break;
                        case "application/msword":
                            $file_type = '.doc';
                            break;
                        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                            $file_type = '.docx';
                            break;
                        case "application/pdf":
                            $file_type = '.pdf';
                            break;
                        default:
                            $file_type = '';
                    }

                    $dataFile = base64_decode($dataFile);
                    $directory = "/uploads/files/" . $folder . "/";
                    $path = public_path() . $directory;
                    if (!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }

                    $file_name = Str::random(10) . $k . $file_type;
                    $file_path = $directory . $file_name;

                    file_put_contents($path . $file_name, $dataFile);

                } else {
                    $file_path = $dataFile;
                    $link->setAttribute('target', '_blank');
                }

                $link->removeAttribute('href');
                $link->setAttribute('href', $file_path);
            }
        }

        //Video
        $videos = $dom->getElementsByTagName('video');
        if (count($videos) > 0) {
            foreach ($videos as $k => $video) {
                $data = $video->getAttribute('src');

                $video->removeAttribute('src');
                $video->setAttribute('src', $data);
            }
        }

        return $dom->saveHTML($dom->documentElement);
    }

}

if (!function_exists('getInFolder')) {
    function getInFolder($image, $folder)
    {
        $path = explode('storage/' . $folder . '/', $image);
        if ($path) {
            return '/storage/' . $folder . '/' . $path[1];
        }
        return false;
    }
}

if (!function_exists('deleteImages')) {
    function deleteImages($images, $folder)
    {
        $path = explode('storage/' . $folder . '/', $images);
        if ($path) {
            @unlink('storage/' . $folder . '/' . $path[1]);
            return true;
        }
        return false;
    }
}

if (!function_exists('getFile')) {
    function getFile($file)
    {
        $files = public_path('files/book/') . $file;
        if (file_exists($files)) {
            return '/files/book/' . $file;
        }
    }
}

if (!function_exists('successJson')) {
    function successJson($data, $message = null)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message ?? 'ok',
            'status' => 200
        ]);
    }
}

if (!function_exists('errorJson')) {
    function errorJson($message = null, $status = null)
    {
        return response()->json([
            'success' => false,
            'data' => '',
            'message' => $message,
            'status' => $status
        ]);
    }
}

if (!function_exists('getTranslates'))
{
    function getTranslates($baseField, $lang){
        $field = "{$baseField}_{$lang}";
        return $field;
    }
}
