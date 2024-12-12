<?php


namespace App\Repositories;

use App\Models\ArtisticFilm;
use App\Traits\ImageUploads;

class ArtisticFilmRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new ArtisticFilm();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz))
        {
            $this->model->where('name_oz', 'ilike', '%'.$request->name_oz.'%');
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru']??null,
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'new_artistic'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'new_artistic'),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'images' => $this->uploads($data['image'], 'artistic'),
            'status' => $data['status']
        ]);
        if ($model){
            return $model;
        };
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if ($model->images)
        {
            deleteImages($model->images, 'artistic');
        }
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru']??null,
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'new_artistic'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'new_artistic'),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'images' => $this->uploads($data['image'], 'artistic'),
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
