<?php


namespace App\Repositories;


use App\Models\FilmAnalysis;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;

class FilmAnalysisRepository extends BaseRepository
{
    use ImageUploads;
    use TelegramMessage;
    public function __construct()
    {
        $this->model = new FilmAnalysis();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz)) {
            $this->model = $this->model->where('name_oz', 'ilike', '%' . $request->name_oz . '%');
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
           $this->model =  $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }

        return $this->model->with('category')->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'category_id' => $data['category_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'analysis'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'analysis'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'analysis'),
            'content_en' => contentByDomDocment($data['content_en'], 'analysis'),
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'analysis'),
        ]);

        try {

            if ($model->telegra_status) {
                $url = explode('/', $model->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/analysis/'.$last);
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
                    $this->sendPhoto($user->telegram_id,$image_path,$caption,$keyboard);
                }

            }

        }catch (\Exception $exception) {
            Log::info('film_analysis: ', [$exception->getMessage()]);
        }
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $item = $this->model->find($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($item->images)
            {
                deleteImages($item->images, 'analysis');
            }
            $images = $this->uploads($data['image'], 'analysis');
        }else {
            $images = $item->images;
        }
        $model = $item->update([
            'category_id' => $data['category_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'analysis'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'analysis'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'analysis'),
            'content_en' => contentByDomDocment($data['content_en'], 'analysis'),
            'status' => $data['status'],
            'images' => $images
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->images)
        {
            deleteImages($model->images, 'analysis');
        }
        if ($model->delete())
        {
            return true;
        }
        return false;
    }

}
