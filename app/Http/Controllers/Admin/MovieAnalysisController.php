<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilmAnalysisRequest;
use App\Models\PersonCategory;
use App\Repositories\FilmAnalysisRepository;
use Illuminate\Http\Request;

class MovieAnalysisController extends Controller
{
    public function __construct(protected Request $request, protected FilmAnalysisRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PersonCategory::where('status', 1)->where('type', 'analysis')->select('id','name_oz','type')->get();
        $models = $this->repo->index($this->request);
        return view('admin.analysis.index', compact('models', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PersonCategory::where('status', 1)->where('type', 'analysis')->select('id','name_oz','type')->get();
        return view('admin.analysis.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmAnalysisRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('film_analysis.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = PersonCategory::where('status', 1)->where('type', 'analysis')->select('id','name_oz','type')->get();
        $model = $this->repo->findById($id);
        return view('admin.analysis.edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilmAnalysisRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('film_analysis.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->repo->delete($id);
        if ($model) {
            session()->flash('success', 'Success');
            return back();
        }else{
            session()->flash('error', 'Errors');
            return back();
        }
    }
}
