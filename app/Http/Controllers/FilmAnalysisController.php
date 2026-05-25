<?php

namespace App\Http\Controllers;

use App\Models\FilmAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FilmAnalysisController extends Controller
{
    public function index(Request $request)
    {
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
            $arr['name'] = $translate->name ?? null;
            $arr['description'] = $translate->description ?? null;
            $arr['content'] = $translate->content ?? null;
            $arr['film_analysis_id'] = $translate->film_analysis_id ?? null;
            $arr['translates'] = $translate->translates ?? null;
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
        $items = FilmAnalysis::where('id', $id)
            ->with(['translates' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }])
            ->first();

        if ($items) {
            $ip = $request->ip();
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $items->view_count + 1;
            if (!Cache::has($cache)) {
                $items->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }

            $translate = $items->translates->first();
            $result = $items->toArray();
            unset($result['translates']);
            $result['name'] = $translate->name ?? null;
            $result['description'] = $translate->description ?? null;
            $result['content'] = $translate->content ?? null;
            $result['film_analysis_id'] = $translate->film_analysis_id ?? null;
            $result['translates'] = $translate->translates ?? null;
            return successJson($result, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }

}
