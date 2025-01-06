<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index($category_id)
    {
        $news = News::where('category_id', $category_id)->where('status', true)->orderBy('id', 'desc')->with('new_category')->paginate(5);
        return view('news.index', ['news' => $news]);
    }

    public function show($id)
    {
        $new = News::where('id', $id)->first();
        return view('news.show', compact('new'));
    }
}
