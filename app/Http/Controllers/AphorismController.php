<?php

namespace App\Http\Controllers;

use App\Http\Resources\AphorismResource;
use App\Models\Aphorism;
use Illuminate\Http\Request;

class AphorismController extends Controller
{
    public function index()
    {
        $models = Aphorism::where('status', true)->with('calendar')->latest()->first();
        $resource = new AphorismResource($models);
        if ($resource){
            return successJson($resource);
        }
        return errorJson('ok', 400);
    }
}
