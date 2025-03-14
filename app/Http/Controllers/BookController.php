<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $params = Books::where('category_id', $result['category_id'])
                ->select('id', 'images', 'files', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'category_id', 'created_at', 'updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }else {
            $params = Books::where('status', 1)
                ->select('id', 'images', 'files', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'category_id', 'created_at', 'updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }
        if ($params) {
            return response()->json(['success' => true, 'data' => $params, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }

    public function show(Request $request, $id)
    {
        $lang = $request->header('lang', 'oz');
        $params = Books::where('id', $id)
            ->select('id', 'images', 'files', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'category_id', 'created_at', 'updated_at')
            ->first();
        if ($params) {
            return response()->json(['success' => true, 'data' => $params, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }
}
