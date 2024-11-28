<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DramaturgyRequest;
use App\Models\PeopleFilmCategory;
use App\Repositories\DramaturgyRepository;
use Illuminate\Http\Request;

class DramaturgyController extends Controller
{
    protected $repo;
    public function __construct(DramaturgyRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index();
        return view('admin.dramaturgy.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 2)->select('id', 'full_name_oz')->get();
        return view('admin.dramaturgy.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DramaturgyRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('dramaturgy.index');
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
        $categories = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 2)->select('id', 'full_name_oz')->get();
        return view('admin.dramaturgy.edit', compact('model','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DramaturgyRequest $request, $id)
    {
        $this->repo->update($request->validated(), $id);
        return redirect()->route('dramaturgy.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->back();
    }
}
