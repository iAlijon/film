<?php

namespace App\Http\Controllers;

use App\Models\PortraitArtist;
use Illuminate\Http\Request;

class PersonDirectorController extends Controller
{
    public function personDirector(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $data = PortraitArtist::where('status', true)
            ->select('id', 'images', 'birth_date', 'full_name_' . $lang . ' as full_name')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }
    public function directorItem(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $data = PortraitArtist::where('id', $id)
            ->select('id', 'images', 'birth_date' ,'full_name_'.$lang.' as full_name', 'description_'.$lang.' as description','content_'.$lang.' as content','created_at')
            ->first();
        if ($data) {
            return response()->json(['success'=>true,'data'=>$data,'message'=>'ok']);
        }
        return response()->json(['success'=>false,'data'=>'','message'=>'ok']);
    }
}
