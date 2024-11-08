<?php


namespace App\Repositories;

use App\Models\InterView;
use App\Traits\ImageUploads;

class InterViewRepository
{
    use ImageUploads;

    public function __construct()
    {
        $this->model = new InterView();
    }


    public function index()
    {
        return $this->model->orderBy('id', 'desc')->paginate(20);
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
            'name_ru' => $data['name_ru'] ?? null,
            'name_en' => $data['name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru'] ?? null,
            'content_en' => $data['content_en'] ?? null,
            'image' => $this->uploads($data['images'], 'interview'),
            'status' => true
        ]);
        if ($model) {
            return $model;
        }
        return false;
    }

    public function update($id, $data)
    {
        $model = $this->model->find($id);
        if ($model->images) {
            unlink($model->images);
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
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => contentByDomDocment($data['content_ru']) ?? null,
            'content_en' => contentByDomDocment($data['content_en']) ?? null,
            'images' => $this->uploads($data['image'], 'interview'),
            'status' => true
        ]);
        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->whereId($id)->first();
        $path = explode('storage/news/',$model->image);
        @unlink('storage/news/'.$path[1]);
        $model->delete();
        return true;
    }


}
