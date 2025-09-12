<?php


namespace App\Repositories;


use App\Http\Filter\NewFilter;
use App\Models\News;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Services\TelegramServices;

class NewsRepository extends BaseRepository
{
    use ImageUploads;
    use TelegramMessage;
    protected $telegram;
    public function __construct(TelegramServices $telegramServices)
    {
        $this->model = new News();
        $this->telegram = $telegramServices;
    }

    public function index($request)
    {
        $filter = new NewFilter($request);
        $filter = $filter->filter();
        return $filter->with('category')->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id)
    {
        return $this->model->whereId($id)->first();
    }

    public function create($data)
    {
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'] ?? null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'news'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'news'),
            'content_ru' => $data['content_ru'],
            'content_en' => $data['content_en'] ?? null,
            'status' => $data['status'],
            'image' => $this->uploads($data['images'], 'news'),
            'category_id' => $data['category_id'],
            'telegram_status' => $data['telegram_status']
        ]);

        try {
            if ($model->telegram_status) {
                $url = explode('/', $model->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/news/'.$last);
                $caption = <<<TEXT
                   $model->name_oz
                   $model->descripton_oz
                TEXT;
                $keyboard = Keyboard::make()->inline()->row([
                    Keyboard::inlineButton([
                        'text' => '🔗 Batafsil',
                        'url' => "https://film-front-javohirs-projects-cf013492.vercel.app/news/{$model->id}"
                    ])
                ]);
                $users = TelegramUser::all();
                foreach ($users as $user) {
                    $this->sendPhoto($user->telegram_id,$image_path,$caption,$keyboard);
                }

            }
        }catch (\Exception $exception) {
            Log::info('news: ', [$exception->getMessage()]);
        }

        if ($model) {
            return $model;
        }

        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if (isset($data['images'])){
            deleteImages($model->images, 'news');
            $image = $this->uploads($data['images'], 'news');
        }else {
            $image = $model->image;
        }
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'] ?? null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'news'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'news'),
            'content_ru' => $data['content_ru'],
            'content_en' => $data['content_en'] ?? null,
            'status' => $data['status'],
            'image' => $image,
            'category_id' => $data['category_id']
        ]);

        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $path = explode('storage/news/', $model->image);
        @unlink('storage/news/' . $path[1]);
        $model->delete();
        return true;
    }


}
