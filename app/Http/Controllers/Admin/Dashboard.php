<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aphorism;
use App\Models\Books;
use App\Models\Calendar;
use App\Models\FilmAnalysis;
use App\Models\Filmography;
use App\Models\Interview;
use App\Models\Kinogit;
use App\Models\News;
use App\Models\PersonCategory;
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
            'aphorism' => Aphorism::count(),
            'calendar' => Calendar::count(),
            'film_digest' => Premiere::count(),
            'film_gid' => Kinogit::count(),
            'filmography' => Filmography::count(),
            'film_analysis' => FilmAnalysis::count(),
            'book' => Books::count(),
            'categories' => PersonCategory::count()
        ];

//        $news = News::orderBy('id', 'desc')->paginate(10);
        return view('admin.index', compact('menus'));
    }
}
