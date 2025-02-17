<?php

namespace App\Http\Controllers;

use App\Models\FilmAnalysis;
use Illuminate\Http\Request;

class FilmAnalysisController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $params = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($params['category_id']) && !empty($params['category_id'])) {
            $items = FilmAnalysis::where('category_id', $params['category_id'])
                ->orderBy('created_at', 'desc')
                ->select('id','category_id','name_'.$lang.' as name','description_'.$lang.' as description','images','created_at','updated_at')
                ->paginate($per_page);
        }else {
            $items = FilmAnalysis::where('status', true)
                ->orderBy('created_at', 'desc')
                ->select('id','category_id','name_'.$lang.' as name','description_'.$lang.' as description','images','created_at','updated_at')
                ->paginate($per_page);
        }
        if ($items) {
            return response()->json(['success' => true,'data' => $items, 'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);

    }


    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $items = FilmAnalysis::where('id', $id)->orderBy('id', 'desc')
            ->select('id','category_id','name_'.$lang.' as name','description_'.$lang.' as description',
                'content_'.$lang.' as content','images','created_at','updated_at')
            ->first();
        if ($items)
        {
            return response()->json(['success' => true,'data' => $items, 'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);
    }

}
