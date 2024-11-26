<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PeopleAssociatedRequest;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Repositories\PeopleAssociatedWithTheFilmRepository;
use Illuminate\Http\Request;

class PeopleFilmController extends Controller
{
    protected $repo;
    public function __construct(PeopleAssociatedWithTheFilmRepository $repo)
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
        $categories = PeopleAssociatedWithTheFilmCategory::query()->select('id', 'name_oz')->get();
        $models = $this->repo->index();
        return view('admin.people_associated.index', compact('categories', 'models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PeopleAssociatedWithTheFilmCategory::select('id', 'name_oz')->get();
        return view('admin.people_associated.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleAssociatedRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('people_film.index');
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
        $categories = PeopleAssociatedWithTheFilmCategory::select('id', 'name_oz')->get();
        return view('admin.people_associated.edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleAssociatedRequest $request, $id)
    {
        $this->repo->update($request->validated(), $id);
        return redirect()->route('people_film.index');
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
        return back();
    }
}
