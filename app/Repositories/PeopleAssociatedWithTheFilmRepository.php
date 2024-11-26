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
        return $this->model->with('category')->orderBy('id', 'desc')->paginate($this->limit);
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
            'full_name_ru' => $data['full_name_ru']??null,
            'full_name_en' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'people_associated_with_the_film_category_id' => $data['profession_id'],
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
            deleteImages($model->images, 'people_associated');
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
            'people_associated_with_the_film_category_id' => $data['profession_id'],
            'images' => $this->uploads($data['images'], 'people_associated')
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
            deleteImages($model->images, 'people_associated');
        }
        $model->delete();
        return true;
    }
}
