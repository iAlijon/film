<?php


namespace App\Repositories;


use App\Http\Filter\DirectorFilter;
use App\Models\Director;
use App\Traits\ImageUploads;

class DirectorRepository extends BaseRepository
{
    use ImageUploads;

    public function __construct()
    {
        $this->model = new Director();
    }

    public function index($request)
    {
        $filter = new DirectorFilter($request);
        $filter = $filter->filter();
        return $filter->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru'] ?? null,
            'full_name_en' => $data['full_name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru'] ?? null,
            'content_en' => $data['content_en'] ?? null,
            'images' => $this->uploads($data['images'], 'director'),
            'status' => true,
            'birth_date' => $data['birth_date']
        ]);


        if ($model) {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if ($model->images) {
            $path = explode('storage/director/', $model->images);
            @unlink('storage/director/' . $path[1]);
        }
        $model = $model->update([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru'] ?? null,
            'full_name_en' => $data['full_name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => contentByDomDocment($data['content_ru']) ?? null,
            'content_en' => contentByDomDocment($data['content_en']) ?? null,
            'images' => $this->uploads($data['images'], 'director'),
            'status' => true,
            'birth_date' => $data['birth_date']
        ]);
        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->where('id', $id)->first();
        if ($model->images) {
            $path = explode('/storage/director/', $model->images);
            @unlink('/storage/director/' . $path[1]);
        }
        $model->delete();
        return true;
    }
}
