<?php

namespace App\Http\Controllers;

use App\Models\FilmAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FilmAnalysisController extends Controller
{
    public function index(Request $request)
    {
//        $lang = $request->header('lang', 'oz');
//        $params = $request->all();
//        $per_page = $result['per_page']??6;
//        if (isset($params['category_id']) && !empty($params['category_id'])) {
//            $items = FilmAnalysis::where('category_id', $params['category_id'])
//                ->with(['translates' => function ($q) use ($lang){
//                    $q->where('translates', $lang);
//                }])
//                ->orderBy('created_at', 'desc')
//                ->paginate($per_page);
//        }else {
//            $items = FilmAnalysis::where('status', 1)
//                ->with(['translates' => function ($q) use ($lang){
//                    $q->where('translates', $lang);
//                }])
//                ->orderBy('created_at', 'desc')
//                ->paginate($per_page);
//        }
//        if ($items) {
//            return successJson($items, 'ok');
//        }
//        return errorJson('Undefined Element', 404);

        $lang = $request->header('lang', 'oz');
        $params = $request->all();
        $per_page = $params['per_page'] ?? 6;

        $query = FilmAnalysis::where('status', 1)
            ->with(['translates' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }])
            ->orderBy('created_at', 'desc');

        if (isset($params['category_id']) && !empty($params['category_id'])) {
            $query->where('category_id', $params['category_id']);
        }

        $data = $query->paginate($per_page);
        $paginatedResult = $data->toArray();

        $paginatedResult['data'] = collect($data->items())->map(function ($item) {
            $translate = $item->translates->first();
            $arr = $item->toArray();
            unset($arr['translates']);

            if ($translate) {
                $arr['name'] = $translate->name;
                $arr['description'] = $translate->description;
                $arr['content'] = $translate->content;
                $arr['film_analysis_id'] = $translate->film_analysis_id;
                $arr['translates'] = $translate->translates;
            }

            return $arr;
        });

        if ($data->isNotEmpty()) {
            return successJson($paginatedResult, 'ok');
        }
        return errorJson('Undefined Element', 404);
    }


    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $items = FilmAnalysis::where('id', $id)->orderBy('id', 'desc')
            ->with(['translates' => function ($q) use ($lang){
                $q->where('translates', $lang);
            }])
            ->first();
        if ($items)
        {
            $ip = $request->ip();
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $items->view_count + 1;
            if (!Cache::has($cache)) {
                $items->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }
            return successJson($items, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }

}
