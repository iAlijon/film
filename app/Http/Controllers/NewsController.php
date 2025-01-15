<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function main()
    {
        $news = News::where('status', true)->orderBy('id', 'desc')->with('new_category:id,name_oz,name_uz')
            ->select('id','name_oz','name_uz','description_oz','description_uz','content_oz','content_uz','image','category_id','created_at')->paginate(3);
        if ($news) {
            return response()->json(['success' => true, 'data' => $news, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }

    public function show($id)
    {
        $new = News::where('id', $id)->first();
        if ($new) {
            return response()->json(['success' => true, 'data' => $new, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'mes sage' => 'ok']);
    }
}
