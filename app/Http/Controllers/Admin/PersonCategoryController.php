<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PersonCategoryRequest;
use App\Models\PersonCategory;
use App\Repositories\PersonCategoryRepository;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;

class PersonCategoryController extends Controller
{
    public function __construct(protected Request $request, protected PersonCategoryRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.person_cate.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.person_cate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonCategoryRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('categories.index');
        }else {
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
        $model = $this->repo->findById($id);
        return view('admin.person_cate.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonCategoryRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('categories.index');
        }else {
            $request->session()->flash('error', 'Errors');
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
        $this->repo->delete($id);
        return redirect()->route('categories.index');
    }

    public function order(Request $request)
    {
        $input = $request->all();
        $model = PersonCategory::where('type', $input)->latest()->first();
        return successJson($model, 'ok');

    }
}
