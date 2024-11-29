<?php


namespace App\Repositories;


use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Models\PeopleFilmCategory;
use App\Traits\ImageUploads;
use Illuminate\Http\Request;

class PeopleAssociatedWithTheFilmRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new PeopleFilmCategory();
    }

    public function index($request)
    {
        if (isset($request->full_name_oz) && !empty($request->full_name_oz))
        {
            $this->model = $this->model->where('full_name_oz', 'ilike', '%'.$request->full_name_oz.'%');
        }

        if (isset($request->category_id) && !empty($request->category_id))
        {
            $category_id = $request->category_id;
            $this->model = $this->model->whereHas('category', function ($q) use ($category_id){
               $q->where('id', $category_id);
            });
        }
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
