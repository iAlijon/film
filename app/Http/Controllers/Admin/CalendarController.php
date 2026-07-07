<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Repositories\CalendarRepository;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function __construct(protected Request $request, protected CalendarRepository $repo)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.calendar.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = Calendar::query()->max('order');
        $order = $model + 1;
        return view('admin.calendar.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'date' => 'required',
            'description' => 'required|string',
            'status' => 'nullable|boolean',
            'translates' => 'nullable',
            'order' => 'required'
        ]);


        $model = $this->repo->create($validation);
        if ($model) {
            $this->request->session()->flash('success', 'Success');
            return redirect()->route('calendar.index');
        }else {
            $this->request->session()->flash('error', 'Errors');
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
        $translates = $this->request->translates ?? 'oz';
        $model = $this->repo->findById($id, $translates);
        return view('admin.calendar.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $translates = $this->request->translates ?? 'oz';
        $model = $this->repo->findById($id, $translates);
        return view('admin.calendar.edit', compact('model'));
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
        $validation = $request->validate([
            'description' => 'required',
            'status' => 'required|boolean',
            'translates' => 'nullable',
            'date' => 'required',
            'order' => 'required'
        ]);
        $model = $this->repo->update($validation, $id);
        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('calendar.index');
        }else {
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
        if ($model) {
            session()->flash('success', 'Success');
            return back();
        }else {
            session()->flash('error', 'Errors');
            return back();
        }
    }
}
