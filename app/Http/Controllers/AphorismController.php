<?php

namespace App\Http\Controllers;

use App\Models\Aphorism;
use Illuminate\Http\Request;

class AphorismController extends Controller
{
    public function index(Request $request)
    {

        $lang = $request->header('lang', 'oz');
        $items = Aphorism::where('status', true)->orderBy('id', 'desc')->with('calendar:id,aphorism_id,created_at,description_'.$lang.' as description')
            ->select('id', 'full_name_'.$lang.' as full_name', 'images', 'description_'.$lang.' as description', 'created_at')->first();
        if ($items){
            return response()->json(['success'=>true, 'data' => $items, 'message'=>'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }
}
