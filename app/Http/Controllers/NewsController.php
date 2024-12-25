<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index($category_id)
    {
        dd($category_id);
        $news = News::where('category_id', $category_id)->where('status', true)->with('new_category')->get();
        return view('news.index', ['news' => $news]);
    }
}
