<?php

namespace App\Http\Controllers;

use App\Models\Premiere;
use Illuminate\Http\Request;

class PremiereController extends Controller
{
    public function premiere(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $premieres = Premiere::where('category_id', $result['category_id'])->where('status', true)
                ->orderBy('id', 'desc')
                ->select('id','category_id','images','created_at','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content')
                ->paginate(6);
            return response()->json(['success' => true,'data' => $premieres,'message'=>'ok']);
        }else{
            $premieres = Premiere::where('status', true)->orderBy('id', 'desc')
                ->select('id','category_id','images','created_at','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content')
                ->paginate(6);
            return response()->json(['success' => true,'data' => $premieres,'message'=>'ok']);
        }
        return response()->json(['success' => false,'data' => '','message'=>'ok']);
    }

    public function premiereItem(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $param = Premiere::where('id', $id)
            ->select('id','category_id','images','name_'.$lang.' as name', 'description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
            ->first();
        if ($param) {
            return response()->json(['success' => true,'data' => $param,'message'=>'ok']);
        }
        return response()->json(['success' => false,'data' => '','message'=>'ok']);
    }
}
