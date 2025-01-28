<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function dictionary(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $data = Dictionary::selectRaw("name->>'$lang' as name")->get();
        return response()->json(['success' => true,'data' => $data,'message' => 'ok']);
    }
}
