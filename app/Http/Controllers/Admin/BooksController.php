<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BooksRequest;
use App\Models\PersonCategory;
use App\Repositories\BooksRepository;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function __construct(protected Request $request, protected BooksRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        $categories = PersonCategory::where('status', true)->where('type', 'books')->select('id','name_oz','type')->get();
        return view('admin.book.index', compact('models','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PersonCategory::where('status', true)->where('type', 'books')->select('id','name_oz','type')->get();
        return view('admin.book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('book.index');
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
        $model = $this->repo->edit($id);
        $categories = PersonCategory::where('status', true)->where('type', 'books')->select('id','name_oz','type')->get();
        return view('admin.book.edit', compact('model', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BooksRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('book.index');
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
        if ($model){
            session()->flash('success', 'Success');
            return redirect()->back();
        }else{
            session()->flash('error', 'Errors');
            return back();
        }
    }

    public function download($id)
    {
        $model = $this->repo->download($id);
        if ($model)
        {
            return $model;
        }else{
            return null;
        }
    }
}
