<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewRequests;
use App\Models\News;
use App\Models\PersonCategory;
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
        $categories = PersonCategory::select('id', 'name_oz', 'name_uz', 'name_ru')->where('type', 'news')->where('status', true)->get();
        $models = $this->repo->index($request);
        return view('admin.news.index', compact('models', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PersonCategory::select('id', 'name_oz', 'name_uz', 'name_ru')->where('type', 'news')->where('status', true)->get();
       return view('admin.news.create', compact('categories'));
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
            $request->session()->flash('success', 'Success');
            return redirect()->route('news.show', $modal->id);
        }else
        {
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
        $model = $this->repo->findById($id);
        return view('admin.news.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = PersonCategory::select('id', 'name_oz', 'name_uz')->where('type', 'news')->where('status', true)->get();
        $model = $this->repo->findById($id);
        return view('admin.news.edit', compact('model', 'categories'));
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
        $model = $this->repo->update($request->validated(), $id);
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('news.show', $model->id);
        }else {
            $request->session()->flash('error', 'Errors');
            return redirect()->route('news.index');
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
        return redirect()->route('news.index');
    }

    public function newStatus(Request $request)
    {
        $data = $request->all();
        $model = News::where('id', $data['id'])->first();
        if ($data['status'])
            $status = 1;
        else
            $status = 0;
        $model->update(['status' => $status]);
        if ($model){
            return $model;
        }
        return null;
    }
}
