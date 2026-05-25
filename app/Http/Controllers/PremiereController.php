<?php

namespace App\Http\Controllers;

use App\Models\Premiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PremiereController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page']??6;

        $query = Premiere::where('status', 1)
            ->whereHas('translates', function ($q) use ($lang) {
                $q->where('translates', $lang);
            })
            ->with(['translates' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }])
            ->orderBy('id', 'desc');

        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $query->where('category_id', $result['category_id']);
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
            }

            return $arr;
        });

        if ($data->isNotEmpty()) {
            return successJson($paginatedResult, 'ok');
        }
        return errorJson('Undefined Element!', 404);


//        if (isset($result['category_id']) && !empty($result['category_id'])) {
//            $data = Premiere::where('category_id', $result['category_id'])->where('status', 1)->whereHas('translates', function ($q) use ($lang){
//                $q->where('translates', $lang);
//            })
//                ->with(['translates' => function ($q) use ($lang){
//                    $q->where('translates', $lang);
//                }])
//                ->orderBy('id', 'desc')
//                ->paginate($per_page);
//        }else{
//            $data = Premiere::where('status', 1)->whereHas('translates', function ($q) use ($lang){
//                $q->where('translates', $lang);
//            })
//                ->with(['translates' => function ($q) use ($lang){
//                    $q->where('translates', $lang);
//                }])
//                ->orderBy('id', 'desc')
//                ->paginate($per_page);
//        }
    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $param = Premiere::where('id', $id)
            ->whereHas('translates', function ($q) use ($lang){
                $q->where('translates', $lang);
            })
            ->with(['translates' => function ($q) use ($lang){
                $q->where('translates', $lang);
            }])
            ->first();
        if ($param) {
            $ip = $request->route('id');
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $param->view_count + 1;
            if (!Cache::has($cache)) {
                $param->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }

            $result = $param->toArray();
            $translates = $param->translates->first();
            unset($result['translates']);

            if ($translates) {
                $result['name'] = $translates->name;
                $result['description'] = $translates->description;
                $result['content'] = $translates->content;
                $result['content'] = $translates->translates;
                $result['premiere_id'] = $translates->premiere_id;

            }
            return successJson($result, 'ok');
        }
        return errorJson('Undefined Element', 404);
    }
}
