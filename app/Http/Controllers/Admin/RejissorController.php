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
    protected $repo;
    public function __construct(RejissorRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = $this->repo->index();
        $directors = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 1)->select('id', 'full_name_oz')->get();
        return view('admin.rejissor.index', compact('models', 'directors'));
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
        $this->repo->create($request->validated());
        return redirect()->route('rejissor.index');
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
        if ($model)
        {
            return redirect()->route('rejissor.index')->withSuccess('Successfully Update &check');
        }else{
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
        return redirect()->back();
    }
}
