<?php

namespace App\Http\Controllers;

use App\Models\Aphorism;
use Illuminate\Http\Request;

class AphorismController extends Controller
{
    public function index()
    {
        $items = Aphorism::where('status', true)->orderBy('id', 'desc')->with('calendar:id,aphorism_id,description_oz,description_uz,created_at')
            ->select('id', 'full_name_oz', 'full_name_uz', 'images', 'description_oz', 'description_uz', 'status', 'created_at')->first();
        if ($items){
            return response()->json(['success'=>true, 'data' => $items, 'message'=>'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }
}
