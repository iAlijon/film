<?php


namespace App\Repositories;


use App\Models\FilmAnalysis;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Telegram\Bot\Keyboard\Keyboard;

class    FilmAnalysisRepository extends BaseRepository
{
    use ImageUploads;
    use TelegramMessage;

    public function __construct()
    {
        $this->model = new FilmAnalysis();
    }

    public function index($request)
    {
        if (isset($request->name) && !empty($request->name)) {
            $name = $request->name;
            $this->model = $this->model->whereHas('translations', function ($q) use ($name) {
                $q->where('name', 'ilike', '%' . $name . '%');
            });
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        $lang = $request->translates ?? 'oz';
        $model = $this->model->whereHas('translates', function ($q) use ($lang) {
            $q->where('translates', $lang);
        });

        return $model->with([
            'category.translates' => function ($q) use ($lang) {
            $q->where('translates', $lang);
        }, 'translates' => function ($q) use ($lang) {
            $q->where('translates', $lang);
        }])->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id, $translates)
    {
        return $this->model->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'slug' => Str::slug($data['name']),
            'category_id' => $data['category_id'],
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'analysis'),
            'order'  => $data['order'],
            'telegram_status' => $data['telegram_status'] ?? false,
            'width_ratio' => $data['width_ratio'] ?? 16,
            'height_ratio' => $data['height_ratio'] ?? 9,
        ]);

        $model->translates()->create([
            'film_analysis_id' => $model->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => contentByDomDocment($data['content'], 'analysis'),
            'translates' => $data['translates']
        ]);

        try {

            if ($model->telegra_status) {
                $url = explode('/', $model->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/analysis/' . $last);
                $caption = <<<TEXT
                    $model->name_oz
                    $model->description_oz
                TEXT;
                $keyboard = Keyboard::make()->inline()->row([
                    Keyboard::inlineButton([
                        'text' => '🔗 Batafsil',
                        'url' => "https://film-front-javohirs-projects-cf013492.vercel.app/analysis/{$model->id}"
                    ])
                ]);
                $users = TelegramUser::all();
                foreach ($users as $user) {
                    $this->sendPhoto($user->telegram_id, $image_path, $caption, $keyboard);
                }

            }

        } catch (\Exception $exception) {
            Log::info('film_analysis: ', [$exception->getMessage()]);
        }
        if ($model) {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $item = $this->model->findOrFail($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($item->images) {
                deleteImages($item->images, 'analysis');
            }
            $images = $this->uploads($data['image'], 'analysis');
        } else {
            $images = $item->images;
        }
        $item->update([
            'category_id' => $data['category_id'],
            'status' => $data['status'],
            'images' => $images,
            'order' => $data['order'],
            'telegram_status' => isset($data['telegram_status']) ? $data['telegram_status'] : false,
            'slug' => Str::slug($data['name']),
            'width_ratio' => $data['width_ratio'] ?? 16,
            'height_ratio' => $data['height_ratio'] ?? 9,
        ]);

        $item->translates()->updateOrCreate([
            'translates' => $data['translates']
           ],[
            'name' => $data['name'],
            'description' => $data['description'],

            'content' => contentByDomDocment($data['content'], 'analysis'),
        ]);

        if ($item) {
            return $item;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model->images) {
            deleteImages($model->images, 'analysis');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }

}
