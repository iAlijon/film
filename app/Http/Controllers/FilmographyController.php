<?php

namespace App\Http\Controllers;

use App\Models\Filmography;
use App\Models\FilmographyGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FilmographyController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $params = Filmography::where('category_id', $result['category_id'])->where('status', 1)
                ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','view_count','created_at','updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }else {
            $params = Filmography::where('status', 1)
                ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','view_count','created_at','updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }

        if ($params) {
            return successJson($params, 'ok');
        }
        return errorJson('Undefined Element !', 404);
    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $data = Filmography::where('id', $id)
            ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','view_count','created_at','updated_at')
            ->first();
        if ($data) {
            $ip = $request->ip();
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $data->view_count + 1;
            if (!Cache::has($cache)) {
                $data->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }
            return successJson($data, 'ok');
        }
        return errorJson('Undefined Element !', 404);
    }
}
