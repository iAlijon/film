<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang') ?? 'oz';
        $result = $request->all();
        $per_page = $result['per_page'] ?? 6;
        $models = Calendar::where('status', true)->with(['translates' => function ($q) use ($lang){
            $q->where('translates', $lang);
        }])->orderBy('id', 'desc');

        $data = $models->paginate($per_page);
        $paginatedResult = $data->toArray();

        $paginatedResult['data'] = collect($data->items())->map(function ($item) {
            $translate = collect($item->translates)->first();
            $arr = $item->toArray();
            unset($arr['translates']);
            $arr['description'] = $translate->description ?? null;
            $arr['translates'] = $translate->translates ?? null;

            return $arr;
        });

        if ($data->isNotEmpty()) {
            return successJson($paginatedResult, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }
}

