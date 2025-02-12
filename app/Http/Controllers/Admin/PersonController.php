<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PersonCategoryRequest;
use App\Http\Requests\Admin\PersonRequest;
use App\Models\PersonCategory;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct(protected Request $request, protected PersonRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        $categories = PersonCategory::where('status', true)->where('type', 'person')->get();
        return view('admin.person.index', compact('models', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PersonCategory::where('status', true)->where('type', 'person')->get();
        return view('admin.person.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('person.index');
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
        $categories = PersonCategory::where('status', true)->where('type', 'person')->get();
        $model = $this->repo->findById($id);
        return view('admin.person.edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('person.index');
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
        return redirect()->route('person.index');
    }
}
