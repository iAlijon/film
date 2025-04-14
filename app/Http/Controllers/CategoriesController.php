<?php

namespace App\Http\Controllers;

use App\Models\PersonCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $categories = PersonCategory::where('status', 1)
            ->select('id','name_'.$lang.' as name','type')
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json(['success' => true, 'data' => $categories, 'message' => 'ok']);
    }
}
