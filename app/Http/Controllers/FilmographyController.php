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

        if (isset($result['date']) && !empty($result['date'])) {
            $query->where('date', $result['date']);
        }

        $data = $query->paginate($per_page);
        $paginatedResult = $data->toArray();

        $paginatedResult['data'] = collect($data->items())->map(function ($item) {
            $translate = $item->translations->first();
            $arr = $item->toArray();
            unset($arr['translations']);
            $arr['name'] = $translate->name ?? null;
            $arr['description'] = $translate->description ?? null;
            $arr['content'] = $translate->content ?? null;
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
            $result['name'] = $translate->name ?? null;
            $result['description'] = $translate->description ?? null;
            $result['content'] = $translate->content ?? null;
            return successJson($result, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }
}
