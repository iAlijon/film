<?php


namespace App\Repositories;


use App\Models\Premiere;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        if (isset($request->name) && !empty($request->name)) {
            $this->model = $this->model->whereHas('translates', function ($q) use ($request){
                $q->where('translates', $request['name']);
            });
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        $translates = $request['translates'] ?? 'oz';
        $this->model = $this->model->whereHas('translates', function ($q) use ($translates){
            $q->where('translates', $translates);
        });
        return $this->model->with(['category.translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
            },
            'translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id, $request)
    {
        $lang = $request['translates'];
        $model = $this->model->findOrFail($id);
        $model->load(['translates' => function ($q) use ($lang){
           $q->where('translates', $lang);
        }]);
        return $model;
    }

    public function create($data)
    {
        $model = $this->model->create([
            'category_id' => $data['category_id'],
            'slug' => Str::slug($data['name']),
            'images' => $this->uploads($data['image'], 'film_digest'),
            'video' => $this->video($data['video']),
            'status' => $data['status'],
            'telegram_status' => $data['telegram_status']??false,
        ]);

        $model->translates()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => contentByDomDocment($data['content'], 'premiere'),
            'translates' => $data['translates']
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
        $model = $this->model->findOrFail($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($model->images) {
                deleteImages($model->images, 'premiere');
            }
            $images = $this->uploads($data['image'], 'premiere');
        }else {
            $images = $model->images;
        }

        if (isset($data['video']) && !empty($data['video'])) {
            // Eski faylni o'chirish
            if ($model->video) {
                $oldPath = public_path($model->video);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Yangi faylni saqlash
            $video = $data['video'];
            $extension = $video->getClientOriginalExtension();
            $full_name = uniqid('video_', true) . '.' . $extension;
            $path = public_path('file/video');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            if ($video->move($path, $full_name)) {
                $videoPath = 'file/video/' . $full_name;
            } else {
                $videoPath = $model->video;
            }
        } else {
            // Video o'zgartirilmagan bo'lsa - eskisini saqlab qolamiz
            $videoPath = $model->video;
        }



        $model->update([
            'category_id' => $data['category_id'],
            'slug' => Str::slug($data['name']),
            'images' => $images,
            'video' => $videoPath,
            'status' => $data['status'],
            'telegram_status' => $data['telegram_status']??false
        ]);

        $model->translates()->updateOrCreate([
            'translates' => $data['translates']
            ],[
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => contentByDomDocment($data['content'], 'premiere'),
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

        }catch (\Exception $exception) {

            Log::info($exception->getMessage());
            Log::info($exception->getCode());

        }

        return $model;
    }

    public function delete($id)
    {
        $model = $this->model->findOrFail($id);
        if ($model->images) {
            deleteImages($model->images, 'premiere');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
