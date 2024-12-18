<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RejissorRequest;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Models\PeopleFilmCategory;
use App\Repositories\RejissorRepository;
use Illuminate\Http\Request;

class RejissorController extends Controller
{
    public function __construct(protected RejissorRepository $repo, protected Request $request){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.rejissor.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directors = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 1)->select('id', 'full_name_oz')->get();
        return view('admin.rejissor.create', compact('directors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RejissorRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('rejissor.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->repo->findById($id);
        $directors = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 1)->select('id', 'full_name_oz')->get();
        return view('admin.rejissor.edit', compact('model', 'directors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(RejissorRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('rejissor.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return redirect()->back()->withErrors('Not update ?');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->back()->withSuccess('Success Delete');
    }
}
