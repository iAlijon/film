<?php


namespace App\Repositories;


use App\Models\Premiere;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;

class PremiereRepository extends BaseRepository
{
    use ImageUploads;
    use TelegramMessage;
    public function __construct()
    {
        $this->model = new Premiere();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz)) {
            $this->model = $this->model->where('name_oz', 'ilike', '%' . $request->name_oz . '%');
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
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
            'content_oz' => contentByDomDocment($data['content_oz'], 'premiere'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'premiere'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'premiere'),
            'content_en' => $data['content_en']??null,
            'images' => $this->uploads($data['image'], 'premiere'),
            'status' => $data['status'],
            'telegram_status' => $data['telegram_status']??false,
        ]);
        try {
            if ($model->telegram_status)
            {
                $url = explode('/', $model->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/premiere/'.$last);
                $caption = <<<TEXT
                🎬: $model->name_oz
                   $model->description_oz
                TEXT;
                $telegramUsers = TelegramUser::all();
                $keyboard = Keyboard::make()->inline()->row([
                    Keyboard::inlineButton([
                        'text' => '🔗 Batafsil',
                        'url' => "https://film-front-javohirs-projects-cf013492.vercel.app/premiere/{$model->id}"
                    ])
                ]);
                foreach ($telegramUsers as $user)
                {
                    $response = $this->sendPhoto($user->telegram_id,$image_path,$caption,$keyboard);
                }
                Log::info($response);
                $model->message_id = $response->getMessageId();
                $model->save();
            }
        }catch (\Exception $exception) {
            Log::info($exception->getMessage());
        }
        return $model;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($model->images) {
                deleteImages($model->images, 'premiere');
            }
            $images = $this->uploads($data['image'], 'premiere');
        }else {
            $images = $model->images;
        }
        $model->update([
            'category_id' => $data['category_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'premiere'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'premiere'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'premiere'),
            'content_en' => $data['content_en']??null,
            'images' => $images,
            'status' => $data['status'],
            'telegram_status' => $data['telegram_status']??false
        ]);
        try {
            if ($model->telegram_status)
            {
                $caption = <<<TEXT
                  🎬: $model->name_oz
                    $model->description_oz
                TEXT;
                $users = TelegramUser::all();
                foreach ($users as $user) {
                    $this->editMessageCaption($user->telegram_id,$model->message_id,$caption);
                }
            }
        }catch (\Exception $exception)
        {
            Log::info($exception->getMessage());
            Log::info($exception->getCode());
        }
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->images) {
            deleteImages($model->images, 'premiere');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
