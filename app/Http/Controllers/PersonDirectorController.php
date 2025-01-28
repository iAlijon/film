<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonCategory;
use Illuminate\Http\Request;

class PersonDirectorController extends Controller
{
    public function personGroup(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $model = PersonCategory::where('status', true)->select('id', 'name_' . $lang . ' as name')->get();
        return response()->json(['success' => true, 'data' => $model, 'message' => 'ok']);
    }

    public function personFilter(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $data = Person::where('person_category_id', $result['category_id'])
            ->select('id', 'person_category_id', 'images', 'birth_date', 'full_name_' . $lang . ' as full_name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content','created_at')
            ->with('person_category:id,name_'.$lang.' as name')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }

    public function person(Request $request, $id)
    {
        $lang = $request->header('lang', 'oz');
        $data = Person::where('id', $id)
            ->select('id', 'person_category_id', 'images', 'birth_date', 'full_name_' . $lang . ' as full_name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content','created_at','updated_at')
            ->first();
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }



}
