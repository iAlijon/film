<?php

if(!function_exists('contentByDomDocment')) {
    function contentByDomDocment($content)
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

                    $directory =  "/uploads/news_content/images/" . date('Y') . "/" . date('m') . "/" . date('d')."/";
                    $path = public_path() . $directory;
                    if(!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }

                    $file_name = str_random(10) . $k . '.jpg';
                    $file_path = $directory . $file_name;

                    file_put_contents($path.$file_name, $data);
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
                if(preg_match('/\bblob:\b/', $dataFile)) {
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
                    $directory =  "/uploads/news_content/files/" . date('Y') . "/" . date('m') . "/" . date('d')."/";
                    $path = public_path() . $directory;
                    if(!is_dir($path)) {
                        mkdir($path, 0755, true);
                    }

                    $file_name = str_random(10) . $k . $file_type;
                    $file_path = $directory . $file_name;

                    file_put_contents($path.$file_name, $dataFile);

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
