<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Bookgroup::where('status', true)->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.bookgroup.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bookgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name_oz' => ['required', 'string'],
            'name_uz' => ['required', 'string'],
            'status' => ['required','boolean']
        ]);
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $data = $request->all();
        $model = Bookgroup::create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'status' => $data['status']
        ]);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('bookgroup.index');
        } else {
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
        $model = Bookgroup::where('id', $id)->first();
        return view('admin.bookgroup.edit', compact('model'));
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
        $validation = Validator::make($request->all(), [
            'name_oz' => ['required', 'string'],
            'name_uz' => ['required', 'string'],
            'status' => ['required','boolean']
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $data = $request->all();
        $model = Bookgroup::where('id', $id)->first();
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'status' => $data['status']
        ]);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('bookgroup.index');
        }else {
            $request->session()->flash('error', 'Errors');
            return back();
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
        $model = Bookgroup::where('id', $id)->first();
        if ($model->delete()) {
            return redirect()->route('bookgroup.index');
        }
        return back();
    }
}
