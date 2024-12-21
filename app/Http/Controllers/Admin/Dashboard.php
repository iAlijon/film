<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActorConversation;
use App\Models\Composer;
use App\Models\Dramaturgy;
use App\Models\News;
use App\Models\Operators;
use App\Models\OtherPeople;
use App\Models\PortraitActor;
use App\Models\PortraitOperator;
use App\Models\PortretRejissor;
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
            'actor_conversation' => ActorConversation::count(),
            'rejissor' => Rejissor::count(),
            'dramaturgy' => Dramaturgy::count(),
            'operator' => Operators::count(),
            'composer' => Composer::count(),
            'other' => OtherPeople::count(),
            'portrait_rejissors' => PortretRejissor::count(),
            'portrait_actor' => PortraitActor::count(),
            'portrait_operator' => PortraitOperator::count(),
        ];
        return view('admin.index', compact('menus'));
    }
}
