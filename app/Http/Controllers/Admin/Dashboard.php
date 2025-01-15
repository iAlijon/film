<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActorConversation;
use App\Models\Aphorism;
use App\Models\Composer;
use App\Models\Dramaturgy;
use App\Models\News;
use App\Models\Operators;
use App\Models\OtherPeople;
use App\Models\PortraitActor;
use App\Models\PortraitOperator;
use App\Models\PortretRejissor;
use App\Models\Premiere;
use App\Models\Rejissor;
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
            'dramaturgy' => Dramaturgy::count(),
        ];

        $news = News::orderBy('id', 'desc')->paginate(10);
        return view('admin.index', compact('menus', 'news'));
    }
}
