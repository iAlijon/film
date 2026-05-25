<?php

namespace App\Http\Controllers;

use App\Models\PersonCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');

        $categories = PersonCategory::where('status', 1)
            ->with(['translates' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }])
            ->orderBy('created_at', 'asc')
            ->get();

        $result = $categories->map(function ($item) {
            $translate = collect($item->translates)->first();
            $arr = $item->toArray();
            unset($arr['translates']);

            $arr['name'] = $translate->name ?? null;
            $arr['translates'] = $translate->translates ?? null;

            return $arr;
        });

        return successJson($result, 'ok');
    }
}

