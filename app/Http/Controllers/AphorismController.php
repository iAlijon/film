<?php

namespace App\Http\Controllers;

use App\Http\Resources\AphorismResource;
use App\Models\Aphorism;
use Illuminate\Http\Request;

class AphorismController extends Controller
{
    public function index(Request $request)
    {
        $translates = $request->header('lang') ?? 'oz';
        $models = Aphorism::where('status', true)->with(['translations' => function ($q) use ($translates) {
            $q->where('translates', $translates);
        }])->latest()->first();
        if (!$models) {
            return errorJson('ok', 400);
        }
        $resource = new AphorismResource($models);
        if ($resource){
            return successJson($resource);
        }
        return errorJson('ok', 400);
    }
}
