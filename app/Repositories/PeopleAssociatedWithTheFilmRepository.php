<?php


namespace App\Repositories;


use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Models\PeopleFilmCategory;
use App\Traits\ImageUploads;

class PeopleAssociatedWithTheFilmRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new PeopleFilmCategory();
    }

    public function index()
    {
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
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
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'people_associated_with_the_film_categories' => $data['profession_id'],
            'images' => $this->uploads($data['images'], 'people_associated')
        ]);
        if ($model){
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        if ($model->images)
        {
            $path = explode('storage/people_associated/', $model->images);
            @unlink('storage/people_associated/'.$path[1]);
        }
        $model->update([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru'],
            'full_name_en' => $data['full_name_en'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'people_associated_with_the_film_categories' => $data['profession_id'],
            'images' => $data['images']
        ]);
        if ($model){
            return $model;
        }
        return false;

    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model->images)
        {
            $path = explode('storage/people_associated/', $model->images);
            @unlink('storage/people_associated/'.$path[1]);
        }
        $model->delete();
        return true;
    }
}
