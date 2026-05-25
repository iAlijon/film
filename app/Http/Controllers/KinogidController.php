<?php

namespace App\Http\Controllers;

use App\Models\Kinogit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KinogidController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang') ?? 'oz';
        $result = $request->all();
        $per_page = $result['per_page'] ?? 6;

        $query = Kinogit::where('status', 1)
            ->with(['translates' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }])
            ->orderBy('created_at', 'desc');

        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $query->where('category_id', $result['category_id']);
        }

        $data = $query->paginate($per_page);
        $paginatedResult = $data->toArray();

        $paginatedResult['data'] = collect($data->items())->map(function ($item) {
            $translate = collect($item->translates)->first();
            $arr = $item->toArray();
            unset($arr['translates']);

            $arr['name'] = $translate->name ?? null;
            $arr['description'] = $translate->description ?? null;
            $arr['content'] = $translate->content ?? null;

            return $arr;
        });

        if ($data->isNotEmpty()) {
            return successJson($paginatedResult, 'ok');
        }
        return errorJson('Undefined Element!', 404);
//        $lang = $request->header('lang') ?? 'oz';
//        $result = $request->all();
//        $per_page = $result['per_page']??6;
//        if (isset($result['category_id']) && !empty($result['category_id'])) {
//            $params = Kinogit::where('category_id', $result['category_id'])->where('status', 1)
//                ->with(['translates' => function ($q) use ($lang){
//                    $q->where('translates' ,$lang);
//                }])
//                ->orderBy('created_at', 'desc')
//                ->paginate($per_page);
//        }else {
//            $params = Kinogit ::where('status', 1)
//                ->with(['translates' => function ($q) use ($lang){
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
    }

    public function show(Request $request,$id)
    {
//        $lang = $request->header('lang', 'oz');
//        $data = Kinogit::where('id', $id)
//            ->with(['translates' => function ($q) use ($lang){
//                $q->where('translates' ,$lang);
//            }])
//            ->first();
//        if ($data) {
//            $ip = $request->ip();
//            $cache = "view_count_{$id}_ip_{$ip}";
//            $count = $data->view_count + 1;
//            if (!Cache::has($cache)) {
//                $data->update([
//                    'view_count' => $count
//                ]);
//                Cache::put($cache, true, now()->addMinutes(3));
//            }
//
//            return successJson($data, 'ok');
//        }
//        return errorJson('Undefined Element !', 404);
        $lang = $request->header('lang', 'oz');
        $data = Kinogit::where('id', $id)
            ->with(['translates' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }])
            ->first();

        if ($data) {
            $ip = $request->ip();
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $data->view_count + 1;
            if (!Cache::has($cache)) {
                $data->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }

            $translate = collect($data->translates)->first();
            $result = $data->toArray();
            unset($result['translates']);

            $result['name'] = $translate->name ?? null;
            $result['description'] = $translate->description ?? null;
            $result['content'] = $translate->content ?? null;

            return successJson($result, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }
}
