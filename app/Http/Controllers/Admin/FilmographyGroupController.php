<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\FilmographyGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmographyGroupController extends Controller
{
    public function __construct(protected FIlmographyGroupRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index();
        return view('admin.filmographygroup.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.filmographygroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name_oz' => 'required|string',
            'name_uz' => 'required|string',
            'status' => 'required|boolean'
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        $model = $this->repo->create($request->all());
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('filmographygroup.index');
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
        return view('admin.filmographygroup.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name_oz' => 'required|string',
            'name_uz' => 'required|string',
            'status' => 'required|boolean'
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        $model = $this->repo->update($request->all(), $id);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('filmographygroup.index');
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
        $model = $this->repo->delete($id);
        if ($model) {
            session()->flash('success', 'Success');
            return redirect()->route('filmographygroup.index');
        }else {
            session()->flash('error', 'Errors');
            return redirect()->back();
        }
    }
}
