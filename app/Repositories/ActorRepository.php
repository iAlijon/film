<?php


namespace App\Repositories;


use App\Http\Filter\ActorFilter;
use App\Models\Actor;
use App\Traits\ImageUploads;

class ActorRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Actor();
    }

    public function index($request)
    {
        $filter = new ActorFilter($request);
        $filter = $filter->filter();
        return $filter->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru']??null,
            'full_name_en' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'images' => $this->uploads($data['image'], 'actor')
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }
}
