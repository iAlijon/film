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
        $per_page = $result['per_page']??6;
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $params = Books::where('category_id', $result['category_id'])
                ->select('id', 'images', 'files', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description',
                     'category_id', 'created_at',
                    'updated_at',
                    'author_'.$lang.' as author',
                    'about_'.$lang.' as about',
                    'date',
                    'view_count'
                )
                ->with('category:id,name_'.$lang.' as name')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }else {
            $params = Books::where('status', 1)
                ->select('id', 'images', 'files', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'category_id', 'created_at', 'updated_at', 'author_'.$lang.' as author',
                    'about_'.$lang.' as about',
                    'date',
                    'view_count'
                )
                ->with('category:id,name_'.$lang.' as name')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }
        if ($params) {
            return successJson($params, 'ok');
        }
        return errorJson('Undefined Element !', 404);
    }

    public function show(Request $request, $id)
    {
        $lang = $request->header('lang', 'oz');
        $data = Books::where('id', $id)
            ->select('id', 'images', 'files', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description',
                'category_id', 'created_at', 'updated_at',
                 'author_'.$lang.' as author',
                 'about_'.$lang.' as about',
                 'date',
                 'view_count'
            )
            ->with('category:id,name_'.$lang.' as name')
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
            return successJson($data, 'ok');
        }
        return errorJson('Undefined Element !', 404);
    }

    public function fileDownload($id){
        $model = Books::where('id', $id)->first();
        $file_name = basename($model->files);
        $path = public_path('files/book/'.$file_name);
        return response()->download($path);
    }
}
