<?php

namespace App\Http\Controllers;

use App\Models\Filmography;
use App\Models\FilmographyGroup;
use Illuminate\Http\Request;

class FilmographyController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $params = Filmography::where('category_id', $result['category_id'])->where('status', true)
                ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }else {
            $params = Filmography::where('status', true)
                ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }

        if ($params) {
            return response()->json(['success'=>true,'data'=>$params,'message'=>'ok']);
        }
        return response()->json(['success'=>false,'data'=>'','message'=>'ok']);
    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $params = Filmography::where('id', $id)
            ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
            ->first();
        if ($params) {
            return response()->json(['success'=>true,'data'=>$params,'message'=>'ok']);
        }
        return response()->json(['success'=>false,'data'=>'','message'=>'ok']);
    }
}
