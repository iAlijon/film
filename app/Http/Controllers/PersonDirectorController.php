<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonCategory;
use Illuminate\Http\Request;

class PersonDirectorController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        if (isset($result['category_id']) && !empty($result['category_id'])) {
            $data = Person::where('category_id', $result['category_id'])
                ->select('id', 'category_id', 'images', 'birth_date', 'full_name_' . $lang . ' as full_name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content','created_at')
                ->orderBy('created_at', 'desc')
                ->paginate($result['per_page']);
        }else {
            $data = Person::where('status', true)
                ->select('id', 'category_id', 'images', 'birth_date', 'full_name_' . $lang . ' as full_name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content','created_at')
                ->orderBy('created_at', 'desc')
                ->paginate($result['per_page']);
        }
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }

    public function show(Request $request, $id)
    {
        $lang = $request->header('lang', 'oz');
        $data = Person::where('id', $id)
            ->select('id', 'category_id', 'images', 'birth_date', 'full_name_' . $lang . ' as full_name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content','created_at','updated_at')
            ->first();
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }



}
