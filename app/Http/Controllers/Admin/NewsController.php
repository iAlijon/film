<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewRequests;
use App\Models\News;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;

class NewsController extends Controller
{
    protected $repo;
    public function __construct(NewsRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = $this->repo->index($request);
        return view('admin.news.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewRequests $request)
    {
        $modal = $this->repo->create($request->validated());
        if ($modal)
        {
            return redirect()->route('index');
        }else
        {
            return back()->with(['message' => 'Error storage']);
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
        return view('admin.news.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewRequests $request, $id)
    {
        $this->repo->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function newStatus(Request $request)
    {
        $data = $request->all();
        $model = News::where('id', $data['id'])->first();
        $model->update(['status' => $data['status']]);
        if ($model){
            return $model;
        }
        return null;
    }
}
