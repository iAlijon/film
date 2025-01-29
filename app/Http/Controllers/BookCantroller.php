<?php

namespace App\Http\Controllers;

use App\Models\Bookgroup;
use App\Models\Books;
use Illuminate\Http\Request;

class BookCantroller extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $params = Bookgroup::where('status', true)->select('id','name_'.$lang.' as name')->orderBy('created_at','asc')->get();
        if ($params) {
            return response()->json(['success'=>true,'data'=>$params,'message'=>'ok']);
        }
        return response()->json(['success'=>false,'data'=>'','message'=>'ok']);
    }

    public function bookFilter(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $params = Books::where('book_category', $result['category_id'])->where('status', true)
            ->select('id','images','files','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','book_category','created_at','updated_at')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        if ($params) {
            return response()->json(['success'=>true,'data'=>$params,'message'=>'ok']);
        }
        return response()->json(['success'=>false,'data'=>'','message'=>'ok']);
    }

    public function bookItem(Request $request, $id)
    {
        $lang = $request->header('lang', 'oz');
        $params = Books::where('book_category', $id)
            ->select('id','images','files','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','book_category','created_at','updated_at')
            ->first();
        if ($params) {
            return response()->json(['success'=>true,'data'=>$params,'message'=>'ok']);
        }
        return response()->json(['success'=>false,'data'=>'','message'=>'ok']);

    }
}
