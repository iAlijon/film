<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function interview(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $data = Interview::where('status', true)
                ->select('id', 'interview_people_id' ,'interview_'.$lang.' as interview', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                ->with('people:id,images,full_name_'.$lang.' as full_name')
                ->orderBy('created_at', 'desc')
                ->paginate(4);
        return response()->json(['success' => true, 'data' => $data, 'message'=>'ok']);
    }

    public function interviewCategory(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $category = PeopleAssociatedWithTheFilmCategory::select('id', 'name_'.$lang.' as name')->get();
        return response()->json(['success'=>true,'data' => $category,'message'=>'ok']);
    }

    public function interviewByCategoryFilter(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        $data = Interview::where('interview_category_id', $result['category_id'])
            ->select('id', 'interview_people_id' ,'interview_'.$lang.' as interview', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
            ->with('people:id,images,full_name_'.$lang.' as full_name')
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => '', 'message' => 'ok']);

    }

    public function interviewItemFilter($id)
    {
        $lang = \request()->header('lang', 'oz');
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
