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
        if (isset($category['category_id'])) {

            $items = FilmAnalysis::where('analysis_category', $category['category_id'])->orderBy('created_at', 'desc')
                ->select('id','analysis_category','name_'.$lang.' as name','description_'.$lang.' as description','images','created_at','updated_at')
                ->paginate(8);
            return response()->json(['success' => true,'data' => $items, 'message' => 'ok']);

        }else {
            $items = FilmAnalysis::where('status', true)->orderBy('created_at', 'desc')
                ->select('id','analysis_category','name_'.$lang.' as name','description_'.$lang.' as description','images','created_at','updated_at')
                ->paginate(8);
            return response()->json(['success' => true,'data' => $items, 'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);

    }


    public function movieItem(Request $request,$item_id)
    {
        $lang = $request->header('lang', 'oz');
        $items = FilmAnalysis::where('id', $item_id)->orderBy('id', 'desc')
            ->select('id','analysis_category','name_'.$lang.' as name','description_'.$lang.' as description',
                'content_'.$lang.' as content','images','created_at','updated_at')
            ->first();
        if ($items)
        {
            return response()->json(['success' => true,'data' => $items, 'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);
    }

    public function category(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $items = [
            '0' => [
                'id' => 1,
                'name_oz'=>'Milliy filmlar tahlili',
                'name_uz' => 'Миллий фильмлар таҳлили'
            ],
            '1' => [
                'id' => 2,
                'name_oz' => 'Xorijiy filmlar tahlili',
                'name_uz' => 'Хорижий фильмлар таҳлили'
            ]
        ];
        $localizedItems = collect($items)->map(function ($item) use ($lang) {
            $nameKey = "name_{$lang}";
            return [
                'id' => $item['id'],
                'name' => $item[$nameKey],
            ];
        });
        return response()->json(['success'=> true,'data' => $localizedItems, 'message' => 'ok'], 200);
    }
}
