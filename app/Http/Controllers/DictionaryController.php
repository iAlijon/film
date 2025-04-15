<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\FilmDictionary;
use App\Models\FilmDictionaryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DictionaryController extends Controller
{
    public function letters(Request $request)
    {
            $lang = $request->header('lang', 'oz');
//        if ($lang == 'uz'){
            $data = Dictionary::select('id','name_'.$lang.' as name')->orderBy('id', 'asc')->get();
            $items = json_decode($data, true);
            $arr = [];
            $outLetter = ['Zh','Ya','Yu','Yo','Shch',"'",'ʼ','Ts','Ь','Ы','Ъ'];
            foreach ($items as $item) {
                $arr[] = [
                    'id' => $item['id'],
                    'name' => json_decode($item['name'], true)['upper'],
                ];
            }
           $filter = collect($arr)->reject(function ($item) use ($outLetter){
              return in_array($item['name'], $outLetter);
           });
            return successJson($filter, 'ok');
//        }
//        $data = Dictionary::select('id','name_'.$lang.' as name')->orderBy('id', 'asc')->get();
//        $items = json_decode($data, true);
//        $arr = [];
//        foreach ($items as $item) {
//            $arr[] = [
//             'id' => $item['id'],
//             'name' => json_decode($item['name'], true)['upper'],
//            ];
//        }
//        return response()->json(['success' => true,'data' => $arr,'message' => 'ok']);
    }

    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $input = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($input['letter_id'])) {
            $result = FilmDictionaryCategory::where('dictionary_category_id', $input['letter_id'])->get();
            $ids = collect($result)->pluck('film_dictionary_id')->filter()->unique()->toArray();
            $data = FilmDictionary::whereIn('id', $ids)->with('film_dictionary_category:id,film_dictionary_id,dictionary_category_id')
                ->select('id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'view_count','created_at', 'updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);

//            foreach ($result as $item) {
//                $params = FilmDictionary::where('id', $item['film_dictionary_id'])->with('film_dictionary_category:id,film_dictionary_id,dictionary_category_id')
//                    ->select('id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'view_count','created_at', 'updated_at')
//                    ->orderBy('created_at', 'desc')
//                    ->paginate($per_page);
//                $arr[] = $params;
//            }
        }else {
            $data = FilmDictionary::query()->where('status', 1)->with('film_dictionary_category:id,film_dictionary_id,dictionary_category_id')
                ->select('id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description', 'content_' . $lang . ' as content', 'view_count','created_at', 'updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }
        if ($data) {
            return successJson($data, 'ok');
        }
        return errorJson('Undefined Element !', 404);
    }

    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $data = FilmDictionary::where('id',$id)->with('film_dictionary_category:id,film_dictionary_id,dictionary_category_id')
            ->select('id','name_'.$lang.' as name','description_'.$lang.' as description','content_'.$lang.' as content','created_at','view_count','updated_at')
            ->first();
        if ($data) {
            $ip = $request->ip();
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $data->view_count + 1;
            if (!Cache::has($cache)) {
                $data->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }
            return successJson($data, 'ok');
        }
        return errorJson('Undefined Element !', 404);
    }
}
