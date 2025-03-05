<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($result['category_id']) && !empty($result['category_id']))
        {
            $data = Interview::where('category_id', $result['category_id'])
                ->select('id', 'interview_people_id' ,'interview_'.$lang.' as interview', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                ->with('people:id,images,full_name_'.$lang.' as full_name')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }else {
            $data = Interview::where('status', 1)
                ->select('id', 'interview_people_id' ,'interview_'.$lang.' as interview', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                ->with('people:id,images,full_name_'.$lang.' as full_name')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }

        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message'=>'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message'=>'ok']);

    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $data = Interview::where('id', $id)
            ->select('id', 'interview_people_id' ,'interview_'.$lang.' as interview', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
            ->with('people:id,images,full_name_'.$lang.' as full_name')
            ->first();
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);
    }
}
