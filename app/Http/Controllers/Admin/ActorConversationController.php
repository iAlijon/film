<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActorConversationRequest;
use App\Models\Actor;
use App\Models\PeopleFilmCategory;
use App\Repositories\ActorConversationRepository;
use Illuminate\Http\Request;

class ActorConversationController extends Controller
{
    public function __construct(protected ActorConversationRepository $repo, protected Request $request){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = $this->repo->index($this->request);
        return view('admin.actor_conversation.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actor_categories = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 6)->select('id', 'full_name_oz')->get();
        return view('admin.actor_conversation.create', compact('actor_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActorConversationRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('actor_conversation.index');
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
        $actors = PeopleFilmCategory::where('people_associated_with_the_film_category_id', 6)->select('id', 'full_name_oz')->get();
        return view('admin.actor_conversation.edit', compact('model', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActorConversationRequest $request, $id)
    {
        $this->repo->update($request->validated(), $id);
        return redirect()->route('actor_conversation.index');
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
        return redirect()->back();
    }
}
