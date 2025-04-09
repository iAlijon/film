<?php

namespace App\Http\Controllers;

use App\Models\Premiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PremiereController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $data = Premiere::where('category_id', $result['category_id'])->where('status', 1)
                ->orderBy('id', 'desc')
                ->select('id','category_id','images','created_at','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','view_count')
                ->paginate($per_page);
        }else{
            $data = Premiere::where('status', 1)->orderBy('id', 'desc')
                ->select('id','category_id','images','created_at','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','view_count')
                ->paginate($per_page);
        }
        if ($data) {
            return successJson($data, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $param = Premiere::where('id', $id)
            ->select('id','category_id','images','name_'.$lang.' as name', 'description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at','view_count')
            ->first();
        if ($param) {
            $ip = $request->route('id');
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $param->view_count + 1;
            if (!Cache::has($cache)) {
                $param->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }
            return successJson($param, 'ok');
        }
        return errorJson('Undefined Element', 404);
    }
}
