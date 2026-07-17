<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KinogidRequest;
use App\Models\Kinogit;
use App\Models\PersonCategory;
use App\Repositories\KinogitRepository;
use Illuminate\Http\Request;

class KinogitController extends Controller
{
    public function __construct(protected Request $request, protected KinogitRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translates = $this->request->translates ?? 'oz';
        $categories = PersonCategory::where('status', 1)->where('type', 'film_grids')->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->get();
        $models = $this->repo->index($this->request);
        return view('admin.kinogit.index', compact('models', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $translates = $this->request->translates ?? 'oz';
        $categories = PersonCategory::where('status', 1)->where('type', 'film_grids')->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->get();
        $order = Kinogit::max('order');
        return view('admin.kinogit.create', compact('categories', 'translates', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KinogidRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('kino_gid.index');
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
        $translates = $this->request->translates ?? 'oz';
        $categories = PersonCategory::where('status', 1)->where('type', 'film_grids')->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->get();
        $model = $this->repo->findById($id, $translates);
        return view('admin.kinogit.edit', compact('categories', 'model', 'translates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KinogidRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('kino_gid.index');
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
        if ($model) {
            session()->flash('success', 'Success');
            return back();
        }else{
            session()->flash('error', 'Errors');
            return back();
        }
    }
}
