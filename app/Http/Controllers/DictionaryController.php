<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\FilmDictionary;
use App\Models\FilmDictionaryCategory;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function dictionary(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        if ($lang == 'uz'){
            $data = Dictionary::select('id','name_ru as name')->orderBy('id', 'asc')->get();
            $items = json_decode($data, true);
            $arr = [];
            foreach ($items as $item) {
                $arr[] = [
                    'id' => $item['id'],
                    'name' => json_decode($item['name'], true)['upper'],
                ];
            }
            return response()->json(['success' => true,'data' => $arr,'message' => 'ok']);
        }
        $data = Dictionary::select('id','name_'.$lang.' as name')->orderBy('id', 'asc')->get();
        $items = json_decode($data, true);
        $arr = [];
        foreach ($items as $item) {
            $arr[] = [
             'id' => $item['id'],
             'name' => json_decode($item['name'], true)['upper'],
            ];
        }
        return response()->json(['success' => true,'data' => $arr,'message' => 'ok']);
    }

    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $input = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($input['dictionary_id'])) {
            $result = FilmDictionaryCategory::where('dictionary_category_id', $input['dictionary_id'])->get();
            $arr = [];
            foreach ($result as $item) {
                $params = FilmDictionary::where('id', $item['film_dictionary_id'])
                    ->select('id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'created_at', 'updated_at')
                    ->orderBy('created_at', 'desc')
                    ->paginate($per_page);
                $arr[] = $params;
            }
        }else {
            $arr = FilmDictionary::query()->where('status', 1)
                ->select('id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'created_at', 'updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }
        if ($arr != []) {
            return response()->json(['success' => true, 'data' => $arr, 'message' => 'ok']);
        }
        return response()->json(['success' => false, 'data' => $params, 'message' => 'ok']);
    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $model = FilmDictionary::where('id',$id)
            ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','updated_at')
            ->first();
        if ($model) return response()->json(['success'=>true,'data'=>$model,'message'=>'ok']);
         return response()->json(['success'=>false,'data'=>'','message'=>'ok']);
    }
}
