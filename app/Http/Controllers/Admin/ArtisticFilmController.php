<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArtisticRequest;
use App\Repositories\ArtisticFilmRepository;
use Illuminate\Http\Request;

class ArtisticFilmController extends Controller
{
    public function __construct(protected Request $request,protected ArtisticFilmRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.artistic.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artistic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtisticRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('artistic_film.index');
        }else{
            $request->session()->flash('error', 'Errors');
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
        $model = $this->repo->model->find($id);
        return view('admin.artistic.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtisticRequest $request, $id)
    {
        $model = $this->repo->model->find($id);
        $result = $this->repo->update($request->validated(), $model->id);
        if ($result)
        {
            $request->session()->flush('success', 'Success');
            return redirect()->route('artistic_film.index');
        }else{
            $request->session()->flush('error', 'Errors');
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
        //
    }
}