<?php

namespace App\Http\Controllers;

use App\Models\FilmAnalysis;
use Illuminate\Http\Request;

class FilmAnalysisController extends Controller
{
    public function movieList(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $category = $request->all();
        if (isset($category['category_id']) && !empty($category['category_id'])) {

            $items = FilmAnalysis::where('category_id', $category['category_id'])->orderBy('created_at', 'desc')
                ->select('id','category_id','name_'.$lang.' as name','description_'.$lang.' as description','images','created_at','updated_at')
                ->paginate(8);
            return response()->json(['success' => true,'data' => $items, 'message' => 'ok']);

        }else {
            $items = FilmAnalysis::where('status', true)->orderBy('created_at', 'desc')
                ->select('id','category_id','name_'.$lang.' as name','description_'.$lang.' as description','images','created_at','updated_at')
                ->paginate(8);
            return response()->json(['success' => true,'data' => $items, 'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);

    }


    public function movieItem(Request $request,$item_id)
    {
        $lang = $request->header('lang', 'oz');
        $items = FilmAnalysis::where('id', $item_id)->orderBy('id', 'desc')
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
