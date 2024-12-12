<?php


namespace App\Repositories;

use App\Models\ArtisticFilm;

class ArtisticFilmRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new ArtisticFilm();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz))
        {
            $this->model->where('name_oz', 'like', '%'.$request->name_oz.'%');
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'new_artistic'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'new_artistic'),
            'content_ru' => $data['content_ru'],
            'content_en' => $data['content_en'],
            'images' => $data['image'],
            'status' => $data['status']
        ]);
        if ($model){
            return $model;
        };
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if ($model->images)
        {
            deleteImages($model->images, 'artistic');
        }
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'new_artistic'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'new_artistic'),
            'content_ru' => $data['content_ru'],
            'content_en' => $data['content_en'],
            'images' => $data['image'],
            'status' => $data['status']
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model){
            deleteImages($model->images, 'artistic');
        }
        if ($model->delete())
        {
            return true;
        }
        return false;

    }
}
