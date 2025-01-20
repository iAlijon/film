<?php

namespace App\Http\Controllers;

use App\Models\ActorConversation;
use App\Models\Composer;
use App\Models\Dramaturgy;
use App\Models\Operators;
use App\Models\OtherPeople;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Models\PeopleFilmCategory;
use App\Models\Rejissor;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function interview(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $data = [
            'actor' => ActorConversation::where('status', true)
                ->select('id','actor_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                ->with('actor:id,images,full_name_'.$lang.' as full_name')
                ->orderBy('created_at', 'desc')
                ->first(),
            'director' => Rejissor::where('status', true)
                ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                ->with('director:id,images,full_name_'.$lang.' as full_name')
                ->orderBy('created_at', 'desc')
                ->first(),
            'dramaturgy' => Dramaturgy::where('status', true)
                ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                ->with('dramaturgy:id,images,full_name_'.$lang.' as full_name')
                ->orderBy('created_at', 'desc')
                ->first(),
            'operator' => Operators::where('status', true)
                ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                ->with('operator:id,images,full_name_'.$lang.' as full_name')
                ->orderBy('created_at', 'desc')
                ->first(),
        ];
        return response()->json(['success' => true, 'data' => $data, 'message'=>'ok']);
    }

    public function interviewCategory(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $category = PeopleAssociatedWithTheFilmCategory::select('id', 'name_'.$lang.' as name')->get();
        return response()->json(['success'=>true,'data' => $category,'message'=>'ok']);
    }

    public function interviewCategoryFilter(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $result = $request->all();
        if (isset($result['category_id'])) {
            switch ($result['category_id']){
                case 1:
                    $data = Rejissor::where('status', true)
                        ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                        ->with('director:id,images,full_name_'.$lang.' as full_name')
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);
                    break;

                case 2:
                    $data = Dramaturgy::where('status', true)
                        ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                        ->with('dramaturgy:id,images,full_name_'.$lang.' as full_name')
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);
                    break;
                case 3:
                    $data = Operators::where('status', true)
                        ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                        ->with('operator:id,images,full_name_'.$lang.' as full_name')
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);
                    break;
                case 4:
                    $data = Composer::where('status', true)
                        ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                        ->with('composer:id,images,full_name_'.$lang.' as full_name')
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);
                    break;
                case 5:
                    $data = OtherPeople::where('status', true)
                        ->select('id','people_film_category_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                        ->with('other:id,images,full_name_'.$lang.' as full_name')
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);
                    break;
                case 6:
                    $data = ActorConversation::where('status', true)
                        ->select('id','actor_id','name_'.$lang.' as name', 'description_'.$lang.' as description', 'content_'.$lang.' as content','created_at')
                        ->with('actor:id,images,full_name_'.$lang.' as full_name')
                        ->orderBy('created_at', 'desc')
                        ->paginate(4);
                    break;
            }
            if ($data) {
                return response()->json(['success' => true,'data' => $data,'message' => 'ok']);
            }
            return response()->json(['success' => false,'data' => '','message' => 'ok']);
        }
        return response()->json(['success' => false,'data' => '','message' => 'ok']);
    }

    public function interviewActor(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $data = ActorConversation::where('status', true)
            ->select('id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description')
            ->with('actor:id,images,full_name_' . $lang . ' as full_name')
            ->paginate(4);
        return response()->json(['success' => true, 'data' => $data, 'message' => 'ok']);
    }
}
