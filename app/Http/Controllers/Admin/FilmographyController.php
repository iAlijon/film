<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AphorismTranslations;
use App\Models\Filmography;
use App\Models\FilmographyTranslations;
use App\Models\PersonCategory;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Telegram\Bot\Keyboard\Keyboard;

class FilmographyController extends Controller
{
    use ImageUploads;
    use TelegramMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = Filmography::query();
        if (isset($request['name']) && !empty($request['name'])){
            $name = $request['name'];
            $model = $model->whereHas('translations', function ($q) use ($name){
                $q->where('name', 'ilike', '%'.$name.'%');
            });
        }
        if (isset($request['category_id']) && !empty($request['category_id'])) {
            $model->where('category_id', $request['category_id']);
        }

        if (isset($request['status']) && !empty($request['status'])) {
            $model->where('status', $request['status']);
        }
        $lang = $request['translates'] ?? 'oz';
        $model = $model->whereHas('translations', function ($q) use ($lang){
            $q->where('translates', $lang);
        });
        $categories = PersonCategory::where('status', 1)->where('type', 'film_catalogs')->with(['translates' => function ($q) use ($lang){
            $q->where('translates', $lang);
        }])->get();
        $models = $model->with(['translations' => function($q) use ($lang){

            $q->where('translates' , $lang);
        }, 'category.translates' => function($q) use ($lang){
            $q->where('translates', $lang);
        }])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.filmography.index', compact('models','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $params = $request->all();
        $translates = $params['translates'] ?? 'oz';
        $categories = PersonCategory::where('status', true)->where('type', 'film_catalogs')->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->get();
        $order = Filmography::max('order');
        return view('admin.filmography.create', compact('categories', 'order'));
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
            'name' => 'required|string',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required',
            'telegram_status' => 'nullable',
            'translates' => 'required',
            'order' => 'required',
            'date' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        if (isset($data->telegram_status)) {
            $telegram = $data['telegram_status'];
        }else {
            $telegram = false;
        }
        $model = Filmography::create([
            'slug' => Str::slug($data['name']),
            'images' => $this->uploads($data['image'], 'filmography'),
            'status' => $data['status'],
            'category_id' => $data['category_id'],
            'telegram_status' => $telegram,
            'order' => $request['order'],
            'date' => $request['date']
        ]);

        FilmographyTranslations::create([
            'filmography_id' => $model->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => $data['content'],
            'translates' => $data['translates']
        ]);
        try {
            if ($model->telegram_status) {
                $url = explode('/', $model->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/filmography/'.$last);
                $caption = <<<TEXT
                    $model->name_oz
                    $model->telegram_status
                TEXT;
                $keyboard = Keyboard::make()->inline()->row([
                   Keyboard::inlineButton([
                       'text' => '🔗 Batafsil',
                       'url' => "https://film-front-javohirs-projects-cf013492.vercel.app/filmography/{$model->id}"
                   ])
                ]);
                $users = TelegramUser::all();
                foreach ($users as $user) {
                    $this->sendPhoto($user->telegram_id,$image_path,$caption,$keyboard);
                }
            }
        }catch (\Exception $exception) {
            Log::info('filmography: ', [$exception->getMessage()]);
        }

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
    public function edit($id, Request $request)
    {
        $translates = $request['translates'] ?? 'oz';
        $categories = PersonCategory::where('status', true)->where('type', 'film_catalogs')->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->get();
        $model = Filmography::where('id', $id)->with(['translations' => function($q) use ($translates){
            $q->where('translates', $translates);
        }])->first();
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
            'name' => 'required|string',
            'description' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required',
            'telegram_status' => 'nullable',
            'order' => 'required',
            'date' => 'required'
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
            'slug' => Str::slug($data['name']),
            'category_id' => $data['category_id'],
            'images' => $images,
            'status' => $data['status'],
            'order' => $data['order'],
            'telegram_status' => isset($data['telegram_status']) ? $data['telegram_status'] : false,
            'date' => $data['date']
        ]);
        $model->translations()->updateOrCreate([
                'translates' => $data['translates']
            ],[
                'name' => $data['name'],
                'description' => $data['description'],
                'content' => contentByDomDocment($data['content'], 'filmography'),
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
            return redirect()->route('filmography.index');
        }
        return back();
    }
}
