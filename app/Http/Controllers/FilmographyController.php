<?php

namespace App\Http\Controllers;

use App\Models\Filmography;
use App\Models\FilmographyGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FilmographyController extends Controller
{
    public function index(Request $request)
    {
//        $lang = $request->header('lang', 'oz');
//        $result = $request->all();
//        $per_page = $result['per_page']??6;
//        if (isset($result['category_id']) && !empty($result['category_id'])) {
//            $params = Filmography::where('category_id', $result['category_id'])->where('status', 1)
//                ->with(['translations' => function ($q) use ($lang){
//                    $q->where('translates' ,$lang);
//                }])
//                ->orderBy('created_at', 'desc')
//                ->paginate($per_page);
//        }else {
//            $params = Filmography::where('status', 1)
//                ->with(['translations' => function ($q) use ($lang){
//                    $q->where('translates' ,$lang);
//                }])
//                ->orderBy('created_at', 'desc')
//                ->paginate($per_page);
//        }
//
//
//        if ($params) {
//            return successJson($params, 'ok');
//        }
//        return errorJson('Undefined Element !', 404);
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page'] ?? 6;

        $query = Filmography::where('status', 1)
            ->with(['translations' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }])
            ->orderBy('created_at', 'desc');

        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $query->where('category_id', $result['category_id']);
        }

        $data = $query->paginate($per_page);
        $paginatedResult = $data->toArray();

        $paginatedResult['data'] = collect($data->items())->map(function ($item) {
            $translate = $item->translations->first();
            $arr = $item->toArray();
            unset($arr['translations']);

            if ($translate) {
                $arr['name'] = $translate->name;
                $arr['description'] = $translate->description;
                $arr['content'] = $translate->content;
            }

            return $arr;
        });

        if ($data->isNotEmpty()) {
            return successJson($paginatedResult, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $items = Filmography::where('id', $id)
            ->with(['translations' => function ($q) use ($lang){
                $q->where('translates' ,$lang);
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

            $translate = $items->translations ? $items->translations->first() : null;
            $result = $items->toArray();
            unset($result['translations']);

            if ($translate) {
                $result['name'] = $translate->name;
                $result['description'] = $translate->description;
                $result['content'] = $translate->content;
            }

            return successJson($result, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }
}
