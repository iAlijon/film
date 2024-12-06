<?php


namespace App\Repositories;


use App\Models\FilmDictionary;
use App\Models\FilmDictionaryCategory;
use App\Traits\ImageUploads;

class FilmDictionaryRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new FilmDictionary();
    }

    public function index($request)
    {
        if (isset($request->dictionary_id) && !empty($request->dictionary_id))
        {
            $this->model->where('id', $request->dictionary_id);
        }

        if (isset($request->name_oz) && !empty($request->name_oz))
        {
            $this->model->where('name_oz', 'ilike', '%'.$request->name_oz.'%');
        }

        return $this->model->where('status', true)->with('film_dictionary_category')->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create($data)
    {
        if (isset($data['image'])){
            $images = $this->uploads($data['image'], 'dictionary');
        }else{
            $images = null;
        }
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru']??null,
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'status' => $data['status'],
            'images' => $images,
        ]);
        foreach ($data['dictionary_id'] as $item){
            FilmDictionaryCategory::create([
                'dictionary_category_id' => $item,
                'film_dictionary_id' => $model->id
        ]);
        }
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
            deleteImages($model->images, 'dictionary');
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
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru'],
            'content_en' => $data['content_en'],
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'dictionary'),
        ]);
        if ($model){
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model)
        {
            deleteImages($model->images, 'dictionary');
        }
        if($model->delete()){
            return true;
        }
        return false;
    }
}
