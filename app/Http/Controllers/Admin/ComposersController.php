<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ComposerRequest;
use App\Models\PeopleFilmCategory;
use App\Repositories\ComposersRepository;
use Illuminate\Http\Request;

class ComposersController extends Controller
{
    public function __construct(protected ComposersRepository $repo)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index();
        return view('admin.composer.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 4)->select('id', 'full_name_oz')->get();
        return view('admin.composer.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComposerRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('composer.index');
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
        $categories = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 4)->select('id', 'full_name_oz')->get();
        $model = $this->repo->findById($id);
        return view('admin.composer.edit', compact('categories', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComposerRequest $request, $id)
    {
        $this->repo->update($request->validated(), $id);
        return redirect()->route('composer.index');
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
