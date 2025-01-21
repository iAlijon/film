<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InterviewPeopleRequest;
use App\Http\Requests\Admin\InterviewRequest;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Repositories\InterviewPeoplesRepository;
use Illuminate\Http\Request;

class InterviewPeoplesController extends Controller
{
    public function __construct(protected Request $request, protected InterviewPeoplesRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        $categories = PeopleAssociatedWithTheFilmCategory::select('id','name_oz')->get();
        return view('admin.interview_people.index', compact('models', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PeopleAssociatedWithTheFilmCategory::select('id','name_oz')->get();
        return view('admin.interview_people.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterviewPeopleRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model) {
            $request->session()->flash('success', 'Success');
            return redirect()->route('interview_peoples.index');
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
        $categories = PeopleAssociatedWithTheFilmCategory::select('id','name_oz')->get();
        $model = $this->repo->findById($id);
        return view('admin.interview_people.edit', compact('model','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InterviewPeopleRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(),$id);
        if ($model) {
            $request->session()->flash('success','Success');
            return redirect()->route('interview_peoples.index');
        }else {
            $request->session()->flash('error','Errors');
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
        $this->repo->delete($id);
        return redirect()->route('interview_peoples.index');
    }
}
