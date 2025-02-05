<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function main(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $news = News::where('status', true)->orderBy('id', 'desc')->with('new_category:id,name_'.$lang.' as name')
            ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','image','category_id','created_at')->paginate(3);
        if ($news) {
            return response()->json(['success' => true, 'data' => $news, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }

}
