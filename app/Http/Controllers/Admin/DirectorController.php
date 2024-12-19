<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DirectorRequest;
use App\Models\UserCategory;
use App\Repositories\DirectorRepository;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function __construct(protected DirectorRepository $repo, protected Request $request){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.director.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = UserCategory::select('id', 'name_oz')->get();
        return view('admin..director.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectorRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model)
            return redirect()->route('director.index');
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repo->findById($id);
        $user->image = explode('storage/director/', $user->images);
        return view('admin.director.show', compact('user'));
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
        return view('admin.director.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DirectorRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model)
            return redirect()->route('redirect.index');
        return false;
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
        return redirect()->route('director.index');
    }
}
