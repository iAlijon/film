<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PopularScienceFilmRequest;
use App\Repositories\PopularScienceFilmRepository;
use Illuminate\Http\Request;

class PopularScienceFilmController extends Controller
{
    public function __construct(protected Request $request, protected PopularScienceFilmRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.popular_science.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.popular_science.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PopularScienceFilmRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model)
        {
            $request->session()->flash('success', 'Success Create');
            return redirect()->route('popular_science_film.index');
        }else{
            $request->session()->flash('error', 'Errors Create');
            return redirect()->back();
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
        $model = $this->repo->findById($id);
        return view('admin.popular_science.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PopularScienceFilmRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model)
        {
            $request->session()->flash('success', 'Success Update');
            return redirect()->route('popular_science_film.index');
        }else{
            $request->session()->flash('error', 'Errors Update');
            return redirect()->back();
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
        if($this->repo->delete($id))
        {
            session()->flash('success', 'Success delete');
            return back();
        }else{
            session()->flash('error', 'Errors delete');
            return back();
        }
    }
}