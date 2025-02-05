<?php

namespace App\Http\Controllers;

use App\Models\Filmography;
use App\Models\FilmographyGroup;
use Illuminate\Http\Request;

class FilmographyController extends Controller
{
    public function filmographyGroup(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $categories = FilmographyGroup::where('status', true)->select('id','name_'.$lang.' as name')->orderBy('created_at','asc')->get();
        return response()->json(['success'=>true,'data'=>$categories,'message'=>'ok']);
    }

    public function filmography(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $params = Filmography::where('filmography_group_id', $result['filmography_id'])->where('status', true)
            ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        if ($params) {
            return response()->json(['success'=>true,'data'=>$params,'message'=>'ok']);
        }
        return response()->json(['success'=>false,'data'=>'','message'=>'ok']);
    }

    public function filmographyItem(Request $request,$id)
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
