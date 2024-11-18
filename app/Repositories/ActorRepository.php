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

    public function findById($id){
        $model = $this->model->whereId($id)->first();
        if ($model)
        {
            return $model;
        }
        return false;
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

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if ($model->images)
        {
            $path = explode('storage/actor/', $model->images);
            @unlink('storage/actor/'.$path[1]);
        }
        $model->update([
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

    public function delete($id)
    {
        $model = $this->findById($id);
//        if ($model->images){
//            $path = explode('storage/actor/', $model->images);
//            @unlink('storage/actor/'.$path[1]);
//        }
        $file = deleteFile($model->images);
        $model->delete();
        return true;
    }
}
