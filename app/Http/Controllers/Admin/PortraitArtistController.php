<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortraitArtistRequest;
use App\Repositories\PortraitArtistRepository;
use Illuminate\Http\Request;

class PortraitArtistController extends Controller
{
    public function __construct(protected Request $request, protected PortraitArtistRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.portrait.artist.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portrait.artist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortraitArtistRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('portrait_artist.index');
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
        $model = $this->repo->findById($id);
        return view('admin.portrait.artist.edit', compact('model'));
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
        $model = $this->repo->update($request->validated(), $id);
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('portrait_artist.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return redirect()->back();
        }
        return redirect()->route('portrait_artist.index');
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
