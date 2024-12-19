<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortretRejissorRequest;
use App\Models\PortretRejissor;
use App\Repositories\PortretRejissorsRepository;
use Illuminate\Http\Request;

class PortretRejissorsController extends Controller
{
    public function __construct(protected PortretRejissorsRepository $repo,protected Request $request){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.portrait.rejissor.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portrait.rejissor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortretRejissorRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model){
            $request->session()->flash('error', 'Success');
            return redirect()->route('portret_rejissors.index');
        }else{
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
        $item = $this->repo->findById($id);
        return view('admin.portrait.rejissor.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortretRejissorRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model){
            $request->session()->flash('error', 'Success');
            return redirect()->route('portret_rejissors.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return redirect()->back();
        }
        return redirect()->route('portret_rejissors.index');
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
