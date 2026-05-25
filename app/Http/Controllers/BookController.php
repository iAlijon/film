<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page'] ?? 6;

        $query = Books::where('status', 1)
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
            $arr['files'] = $translate->files ?? null;
            $arr['images'] = $translate->images ?? null;
            $arr['author'] = $translate->author ?? null;
            $arr['about'] = $translate->about ?? null;
            $arr['date'] = $translate->date ?? null;

            return $arr;
        });

        if ($data->isNotEmpty()) {
            return successJson($paginatedResult, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }

    public function show(Request $request, $id)
    {
//        $lang = $request->header('lang', 'oz');
//        $data = Books::where('id', $id)
//            ->with(['translates' => function ($q) use ($lang){
//                $q->where('translates', $lang);
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
//            return successJson($data, 'ok');
//        }
//        return errorJson('Undefined Element !', 404);
        $lang = $request->header('lang', 'oz');
        $data = Books::where('id', $id)
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
            $result['files'] = $translate->files ?? null;
            $result['images'] = $translate->images ?? null;
            $result['author'] = $translate->author ?? null;
            $result['about'] = $translate->about ?? null;
            $result['date'] = $translate->date ?? null;

            return successJson($result, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }

    public function fileDownload($id){
        $model = Books::with('translates')->find($id);
        $file_name = basename($model->translates->files);
        $path = public_path('files/book/'.$file_name);
        return response()->download($path);
    }
}
