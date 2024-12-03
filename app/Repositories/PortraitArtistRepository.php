<?php


namespace App\Repositories;


use App\Models\PortraitArtist;
use App\Traits\ImageUploads;

class PortraitArtistRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new PortraitArtist();
    }

    public function index($request)
    {
        if (isset($request->full_name_oz) && !empty($request->full_name_oz))
        {
            $this->model->where('full_name_oz', 'ilike', '%'.$request->full_name_oz.'%');
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create($data)
    {
        $model = $this->model->create([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_en' => $data['full_name_ru']??null,
            'full_name_ru' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_en' => $data['description_ru']??null,
            'description_ru' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'birth_date' => $data['birth_date'],
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'portrait_artist')
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if ($model->images)
        {
            deleteImages($model->images, 'portrait_artist');
        }
        $model->update([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_en' => $data['full_name_ru']??null,
            'full_name_ru' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_en' => $data['description_ru']??null,
            'description_ru' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'birth_date' => $data['birth_date'],
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'portrait_artist')
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
        if ($model)
        {
            deleteImages($model->images, 'portrait_artist');
        }
        if($model->delete()){
            return true;
        }
        return false;
    }
}
