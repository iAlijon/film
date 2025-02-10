<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function main(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $news = News::where('status', true)->orderBy('id', 'desc')
            ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','category_id','created_at')->paginate(3);
        if ($news) {
            return response()->json(['success' => true, 'data' => $news, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }

    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $news = News::where('category_id', $result['category_id'])->where('status', true)
                ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','category_id','created_at')
                ->orderBy('created_at' ,'desc')
                ->paginate(6);
        }else {
            $news = News::where('status', true)
                ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','category_id','created_at')
                ->orderBy('created_at' ,'desc')
                ->paginate(6);
        }
        return response()->json(['success' => true,'data' => $news, 'message' => 'ok']);
    }

    public function newsItem($id)
    {
        $lang = \request()->header('lang', 'oz');
        $new = News::where('id', $id)
            ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','category_id','created_at')
            ->first();
        if ($new) {
            return response()->json(['success' => true,'data' => $new, 'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '', 'message' => 'ok']);
    }

}
