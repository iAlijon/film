<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilmDictionaryRequest;
use App\Repositories\FilmDictionaryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmDictionaryController extends Controller
{
    public function __construct(protected FilmDictionaryRepository $repo, protected Request $request){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.dictionary.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dictionaries = DB::table('dictionary')->select('id', 'ru')->get();
        dd($dictionaries);
        return view('admin.dictionary.create', compact('dictionaries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmDictionaryRequest $request)
    {
       $this->repo->create($request->validated());
       return redirect()->route('film_dictionary.index');
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
        return view('admin.dictionary.index', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilmDictionaryRequest $request, $id)
    {
        $this->repo->update($request->validated(), $id);
        return redirect()->route('film_dictionary.index');
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
