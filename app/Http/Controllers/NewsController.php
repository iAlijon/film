<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $news = News::where('category_id', $result['category_id'])->where('status', 1)
                ->select('id','category_id','image','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','created_at','status','view_count')
                ->orderBy('created_at' ,'desc')
                ->paginate($per_page);
        }else {
            $news = News::where('status', 1)
                ->select('id','category_id','image','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','created_at','status','view_count')
                ->orderBy('created_at' ,'desc')
                ->paginate($per_page);
        }
        if ($news) {
            return response()->json(['success' => true,'data' => $news, 'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);
    }

    public function show($id)
    {
        $lang = \request()->header('lang', 'oz');
        $new = News::where('id', $id)
            ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','category_id', 'view_count','created_at')
            ->first();
        if ($new) {
            return successJson($new, 'ok');
        }
        return errorJson('Undefined news !', 404);
//        if ($new) {
//            $count = $new->view_count + 1;
//            $new->update([
//               'view_count' =>  $count
//            ]);
//            return response()->json(['success' => true,'data' => $new, 'message' => 'ok']);
//        }
//        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);
    }

}
