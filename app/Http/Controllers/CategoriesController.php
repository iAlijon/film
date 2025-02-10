<?php

namespace App\Http\Controllers;

use App\Models\PersonCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $categories = PersonCategory::where('status', true)
            ->select('id','name_'.$lang.' as name','type')
            ->get();
        return response()->json(['success' => true, 'data' => $categories, 'message' => 'ok']);
    }
}
