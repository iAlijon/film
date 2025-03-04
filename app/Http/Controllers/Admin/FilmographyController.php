<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filmography;
use App\Models\PersonCategory;
use App\Repositories\FilmographyRepository;
use App\Traits\ImageUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FilmographyController extends Controller
{
    use ImageUploads;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = $request->all();
        if (isset($result['name_oz']) && !empty($result['name_oz'] || isset($result['category_id']) && !empty($result['category_id']))) {
            if (isset($result['name_oz']) && !empty($result['name_oz'])) {
                $model = Filmography::where('name_oz', 'ilike','%'.$result['name_oz'].'%');
            }
            if (isset($result['category_id']) && !empty($result['category_id'])) {
                $model = Filmography::where('filmography_group_id', $result['category_id']);
            }
        }else {
            $model = Filmography::query();
        }
        $categories = PersonCategory::where('status', true)->where('type', 'filmography')->select('id','name_oz')->get();
        $models = $model->select('id','category_id','name_oz','name_uz','description_oz','description_uz','content_oz','content_uz','images','created_at','updated_at')
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.filmography.index', compact('models','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PersonCategory::where('status', true)->where('type', 'filmography')->select('id','name_oz')->get();
        return view('admin.filmography.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_oz' => 'required|string',
            'name_uz' => 'required|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $model = Filmography::create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'filmography'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'filmography'),
            'images' => $this->uploads($data['image'], 'filmography'),
            'status' => $data['status'],
            'category_id' => $data['category_id']
        ]);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('filmography.index');
        }else {
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
        $categories = PersonCategory::where('status', true)->where('type', 'filmography')->select('id','name_oz')->get();
        $model = Filmography::where('id', $id)->first();
        return view('admin.filmography.edit', compact('categories', 'model'));
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
        $validator = Validator::make($request->all(), [
            'name_oz' => 'required|string',
            'name_uz' => 'required|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $model = Filmography::where('id', $id)->first();
        $data = $request->all();
        if (isset($data['image']) && !empty($data['image'])) {
            if ($model->images) {
                deleteImages($model->images, 'filmography');
            }
            $images = $this->uploads($data['image'], 'filmography');
        }else {
            $images = $model->images;
        }
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'filmography'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'filmography'),
            'images' => $images,
            'status' => $data['status'],
            'filmography_group_id' => $data['category_id']
        ]);

        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('filmography.index');
        }else {
            $request->session()->flash('error', 'Errors');
            return redirect()->back();
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
        $model = Filmography::where('id', $id)->first();
        if ($model->images) {
            deleteImages($model->images, 'filmography');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
