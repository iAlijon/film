<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentaryRequest;
use App\Repositories\DocumentaryRepository;
use Illuminate\Http\Request;

class DocumentaryController extends Controller
{
    public function __construct(protected Request $request, protected DocumentaryRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.documentary.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.documentary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentaryRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('documentary.index');
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
        return view('admin.documentary.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentaryRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('documentary.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return back();
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
        if ($model)
        {
            session()->flash('success', 'Success');
            return back();
        }else{
            session()->flash('error', 'Errors');
            return back();
        }
    }
}
