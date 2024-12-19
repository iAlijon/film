<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PeopleAssociatedRequest;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Repositories\PeopleAssociatedWithTheFilmRepository;
use Illuminate\Http\Request;

class PeopleFilmController extends Controller
{

    public function __construct(protected PeopleAssociatedWithTheFilmRepository $repo, protected Request $request){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PeopleAssociatedWithTheFilmCategory::query()->select('id', 'name_oz')->get();
        $models = $this->repo->index($this->request);
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
        $model = $this->repo->create($request->validated());
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('people_film.index');
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
        $model = $this->repo->update($request->validated(), $id);
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('people_film.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return back();
        }
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
        return redirect()->route('people_film.index');
    }
}
