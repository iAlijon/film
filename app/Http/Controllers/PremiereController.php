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
        dd($data->getCollection()->first()->translates);
        $items = $data->getCollection()->map(function ($item){
            $item->translates = $item->translates->first();
            return $item;
        });

        $data->setCollection($items);

        if ($data) {
            return successJson($data, 'ok');
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
            return successJson($param, 'ok');
        }
        return errorJson('Undefined Element', 404);
    }
}
