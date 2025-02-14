<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PremiereRequest;
use App\Models\PersonCategory;
use App\Repositories\PremiereRepository;
use Illuminate\Http\Request;

class PremiereController extends Controller
{
    public function __construct(protected Request $request, protected PremiereRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PersonCategory::where('status', true)->where('type', 'premiere')->get();
        $models = $this->repo->index($this->request);
        return view('admin.premiere.index', compact('models', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PersonCategory::where('status', true)->where('type', 'premiere')->get();
        return view('admin.premiere.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PremiereRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('premiere.index');
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
        $categories = PersonCategory::where('status', true)->where('type', 'premiere')->get();
        $model = $this->repo->findById($id);
        return view('admin.premiere.edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PremiereRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('premiere.index');
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
        return redirect()->back();
    }
}
