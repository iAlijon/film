<?php

namespace App\Http\Controllers;

use App\Models\Premiere;
use Illuminate\Http\Request;

class PremiereController extends Controller
{
    public function premiere()
    {
        $premieres = Premiere::where('status', true)->orderBy('id', 'desc')
            ->select('id','premiere_category','images','created_at')
            ->paginate(6);
        if ($premieres)
        {
            return response()->json(['success' => true,'data' => $premieres,'message'=>'ok']);
        }
        return response()->json(['success' => false,'data' => '','message'=>'ok']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function premierCategoryList($premiere_id)
    {
        $items = Premiere::where('premiere_category', $premiere_id)
            ->select('id','premiere_category','images','created_at')
            ->paginate(6);
        if ($items)
        {
            return response()->json(['success' => true,'data' => $items,'message'=>'ok']);
        }
        return response()->json(['success' => false,'data' => '','message'=>'ok']);
    }

    public function premiereItem(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $param = Premiere::where('id', $id)
            ->select('id','premiere_category','images','name_'.$lang.' as name', 'description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
            ->first();
        if ($param) {
            return response()->json(['success' => true,'data' => $param,'message'=>'ok']);
        }
        return response()->json(['success' => false,'data' => '','message'=>'ok']);
    }
}
