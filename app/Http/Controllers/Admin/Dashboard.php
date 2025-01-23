<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aphorism;
use App\Models\Interview;
use App\Models\News;
use App\Models\Premiere;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menus = [
            'news' => News::count(),
            'aphorism' => Aphorism::count(),
            'premiere' => Premiere::count(),
            'interview' => Interview::count(),
        ];

        $news = News::orderBy('id', 'desc')->paginate(10);
        return view('admin.index', compact('menus', 'news'));
    }
}
