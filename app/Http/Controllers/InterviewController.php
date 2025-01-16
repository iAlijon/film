<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function interview(Request $request)
    {
        $lang = $request->header('lang', 'oz');


    }
}
