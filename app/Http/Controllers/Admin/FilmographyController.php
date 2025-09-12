<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filmography;
use App\Models\PersonCategory;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
        $result = $request->all();
        if (isset($result['name_oz']) && !empty($result['name_oz']) || isset($result['category_id']) && !empty($result['category_id']) || isset($result['status']) && !empty($result['status'])) {
            if (isset($result['name_oz']) && !empty($result['name_oz'])) {
                $model = Filmography::where('name_oz', 'ilike','%'.$result['name_oz'].'%');
            }
            if (isset($result['category_id']) && !empty($result['category_id'])) {
                $model = Filmography::where('category_id', $result['category_id']);
            }
            if (isset($result['status']) && !empty($result['status'])) {
                $model = Filmography::where('status', $result['status']);
            }
        }else {
            $model = Filmography::query();
        }
        $categories = PersonCategory::where('status', 1)->where('type', 'filmography')->select('id','name_oz')->get();
        $models = $model->select('id','category_id','name_oz','description_oz','content_oz','images','created_at','updated_at','status')
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
            'name_ru' => 'required|string',
            'name_en' => 'nullable|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'nullable',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'content_ru' => 'required',
            'content_en' => 'nullable',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required',
            'telegram_status' => 'nullable'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $model = Filmography::create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'filmography'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'filmography'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'filmography'),
            'content_en' => contentByDomDocment($data['content_en'], 'filmography'),
            'images' => $this->uploads($data['image'], 'filmography'),
            'status' => $data['status'],
            'category_id' => $data['category_id'],
            'telegram_status' => $data['telegram_status']
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
            'name_ru' => 'required|string',
            'name_en' => 'nullable|string',
            'description_oz' => 'required',
            'description_uz' => 'required',
            'description_ru' => 'required',
            'description_en' => 'nullable',
            'content_oz' => 'required',
            'content_uz' => 'required',
            'content_ru' => 'required',
            'content_en' => 'nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required',
            'telegram_status' => 'nullable'
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
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'filmography'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'filmography'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'filmography'),
            'content_en' => contentByDomDocment($data['content_en'], 'filmography'),
            'images' => $images,
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
