<?php


namespace App\Repositories;


use App\Models\FilmDictionary;
use App\Models\FilmDictionaryCategory;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;

class FilmDictionaryRepository extends BaseRepository
{
    use ImageUploads;
    use TelegramMessage;
    public function __construct()
    {
        $this->model = new FilmDictionary();
    }

    public function index($request)
    {
        if (isset($request->dictionary_id) && !empty($request->dictionary_id)) {
            $dictionary_id = $request->dictionary_id;
            $this->model = $this->model->whereHas('film_dictionary_category', function ($q) use ($dictionary_id){
                $q->where('dictionary_category_id', $dictionary_id);
            });
        }
        if (isset($request->name_oz) && !empty($request->name_oz)) {
            $this->model = $this->model->where('name_oz', 'ilike', '%' . $request->name_oz . '%');
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        return $this->model->with('film_dictionary_category')->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->with('film_dictionary_category')->first();
    }

    public function create($data)
    {
        if (isset($data['image'])) {
            $images = $this->uploads($data['image'], 'dictionary');
        } else {
            $images = null;
        }
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'] ?? null,
            'name_en' => $data['name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'dictionary'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'dictionary'),
            'content_ru' => $data['content_ru'] ?? null,
            'content_en' => $data['content_en'] ?? null,
            'status' => $data['status'],
            'images' => $images,
            'telegram_status' => $data['telegram_status']
        ]);

        foreach ($data['dictionary_id'] as $item) {
            FilmDictionaryCategory::create([
                'dictionary_category_id' => $item,
                'film_dictionary_id' => $model->id
            ]);
        }

        try {

            if ($data['telegram_status']) {
                $url = explode('/', $model->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/dictionary/'.$last);
                $caption = <<<TEXT
                    $model->name_oz
                    $model->description_oz
                TEXT;
                $users = TelegramUser::all();
                $keyboard = Keyboard::make()->inline()->row([
                    Keyboard::inlineButton([
                        'text' => '🔗 Batafsil',
                        'url' => "https://film-front-javohirs-projects-cf013492.vercel.app/dictionary/{$model->id}"
                    ])
                ]);
                foreach ($users as $user) {
                    $this->sendPhoto($user->telegram_id,$image_path,$caption,$keyboard);
                }
            }
        }catch (\Exception $exception) {
            Log::info('dictionary: ',[$exception->getMessage()]);
        }

        if ($model) {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if ($model->images) {
            deleteImages($model->images, 'dictionary');
        }
        if (isset($data['image'])) {
            $images = $this->uploads($data['image'], 'dictionary');
        } else {
            $images = null;
        }
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'] ?? null,
            'name_en' => $data['name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'dictionary'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'dictionary'),
            'content_ru' => $data['content_ru'] ?? null,
            'content_en' => $data['content_en'] ?? null,
            'status' => $data['status'],
            'images' => $images,
        ]);
        $dictionaries = array_unique(array_filter($data['dictionary_id']));
        $results = FilmDictionaryCategory::where('film_dictionary_id', $model->id)->get();
        if (!empty($results))
        {

            foreach ($results as $result)
            {
                $result->delete();
            }

            foreach ($dictionaries as $k => $item) {
                FilmDictionaryCategory::create([
                    'dictionary_category_id' => $item,
                    'film_dictionary_id' => $model->id
                ]);
            }
        }else{
            foreach ($dictionaries as $item) {
                FilmDictionaryCategory::create([
                    'dictionary_category_id' => $item,
                    'film_dictionary_id' => $model->id
                ]);
            }
        }

        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model) {
            deleteImages($model->images, 'dictionary');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
