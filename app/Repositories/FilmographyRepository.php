<?php


namespace App\Repositories;


use App\Models\Filmography;
use App\Traits\ImageUploads;

class FilmographyRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Filmography();
    }

    public function index($request)
    {
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->name_oz) && !empty($request->name_oz)) {
            $this->model = $this->model->where('name_oz', 'ilike','%'.$request->name_oz.'%');
        }
        return $this->model->orderBy('created_at','desc')->paginate($this->limit);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru']??null,
            'name_en' => $data['name_en']??null,
            'category_id' => $data['category_id'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'filmography'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'filmography'),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'images' => $this->uploads($data['image'], 'filmography'),
            'status' => $data['status']
        ]);
        if ($model){
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->where('id', $id)->first();
        if ($model->images) {
            deleteImages($model->images, 'filmography');
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
            'content_oz' => contentByDomDocment($data['content_oz'], 'filmography'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'filmography'),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'images' => $this->uploads($data['image'], 'filmography'),
            'status' => $data['status']
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }
}
