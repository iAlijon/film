<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InterviewRequest;
use App\Models\InterviewPeoples;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Repositories\InterviewRepository;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function __construct(protected Request $request, protected InterviewRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PeopleAssociatedWithTheFilmCategory::query()->select('id','name_oz')->get();
        $peoples = InterviewPeoples::select('id', 'full_name_oz')->get();
        $models = $this->repo->index($this->request);
        return view('admin.interview.index', compact('models', 'peoples', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PeopleAssociatedWithTheFilmCategory::query()->select('id','name_oz')->get();
        $peoples = InterviewPeoples::query()->select('id', 'full_name_oz')->get();
        return view('admin.interview.create', compact('peoples', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterviewRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('interview.index');
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
        $categories = PeopleAssociatedWithTheFilmCategory::query()->select('id','name_oz')->get();
        $peoples = InterviewPeoples::query()->select('id', 'full_name_oz')->get();
        $model = $this->repo->findById($id);
        return view('admin.interview.edit', compact('categories', 'peoples', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InterviewRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('interview.index');
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
        $model = $this->repo->delete($id);
        if ($model) {
            return redirect()->route('interview.index');
        }
        return redirect()->back();
    }

    public function interviewStatus(Request $request)
    {
        $result = $request->all();
        if ($result['category_id']) {
            $params = InterviewPeoples::where('interview_category_id', $result['category_id'])->select('id', 'interview_category_id','full_name_oz')->get();

        }else{
            $params = InterviewPeoples::select('id','interview_category_id','full_name_oz')->get();
        }
        return $params;

    }
}
