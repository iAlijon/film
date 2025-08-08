<?php


namespace App\Repositories;


use App\Http\Filter\NewFilter;
use App\Models\News;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Services\TelegramServices;

class NewsRepository extends BaseRepository
{
    use ImageUploads;
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
            'category_id' => $data['category_id']
        ]);
        $this->telegram->sendToTelegram($model);
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
