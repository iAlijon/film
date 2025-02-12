<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\InterviewCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InterviewCategoryController extends Controller
{
    public function __construct(protected InterviewCategoryRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index();
        return view('admin.interview_category.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.interview_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_oz' => 'required',
            'name_uz' => 'required',
            'name_ru' => 'nullable',
            'name_en' => 'nullable',
            'status' => 'required|boolean'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $model = $this->repo->create($data);
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('interview_category.index');
        }else {
            $request->session()->flash('error', 'Errors');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->repo->findById($id);
        return view('admin.interview_category.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_oz' => 'required',
            'name_uz' => 'required',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $model = $this->repo->update($request->all(), $id);
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('interview_category.index');
        }else {
            $request->session()->flash('error', 'Errors');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('interview_category.index');
    }
}
