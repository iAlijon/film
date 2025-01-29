<?php

namespace App\Http\Controllers;

use App\Models\CinemaFact;
use Illuminate\Http\Request;

class FilmFactController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $models = CinemaFact::where('status', true)
            ->select('id','images','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
            ->orderBy('created_at','desc')
            ->paginate(2);
        if ($models) {
            return response()->json(['success' => true,'data' => $models,'message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '','message' => 'ok']);
    }
}
