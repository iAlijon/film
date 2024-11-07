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
        $input = $request->all();
        $news = new News();
        if (isset($input['name_oz']) && empty($input['name_oz'])) {
            $news->where('name_oz', 'like', '%' . $input['name_oz'] . '%')->get();
        }
        if (isset($input['name_uz']) && empty($input['name_uz'])) {
            $news->where('name_uz', 'like', '%' . $input['name_uz'] . '%')->get();
        }
        if (isset($input['description_oz']) && empty($input['description_oz'])) {
            $news->where('description_oz', 'like', '%' . $input['description_oz'] . '%')->get();
        }
        if (isset($input['description_uz']) && empty($input['description_uz'])) {
            $news->where('description_uz', 'like', '%' . $input['description_uz'] . '%')->get();
        }

        $models = $this->repo->index();
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
            return redirect()->route('news.index');
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
        return view('admin.news.show');
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
        return view('admin.news.edit', compact('model'));
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
            return redirect()->route('news.index');
        }
        return false;
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
        $model->update(['status' => $data['status']]);
        if ($model){
            return $model;
        }
        return null;
    }
}
