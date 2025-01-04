<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index($category_id)
    {
        $news = News::where('category_id', $category_id)->where('status', true)->with('new_category')->paginate(5);
//        dd($news);
        return view('news.index', ['news' => $news]);
    }
}
