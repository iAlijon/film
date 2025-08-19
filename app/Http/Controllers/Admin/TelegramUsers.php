<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TelegramUser;
use Illuminate\Http\Request;

class TelegramUsers extends Controller
{
    public function index()
    {
        $models = TelegramUser::paginate(20);
        return view('admin.telegram.index', ['models' => $models]);
    }
}
