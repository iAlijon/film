<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortraitOperatorRequest;
use App\Repositories\PortraitOperatorRepository;
use Illuminate\Http\Request;

class PortraitOperatorController extends Controller
{
    public function __construct(protected PortraitOperatorRepository $repo, protected Request $request)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.portrait.operator.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portrait.operator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortraitOperatorRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('portrait_operator.index');
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
        return view('admin.portrait.operator.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortraitOperatorRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('portrait_operator.index');
        }else{
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
        return back();
    }
}
