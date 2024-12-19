<?php


namespace App\Repositories;


use App\Models\Operators;

class OperatorsRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model = new Operators();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz)){
            $this->model = $this->model->where('name_oz', 'ilike','%'.$request->name_oz.'%');
        }
        if (isset($request->operator_id) && !empty($request->operator_id)){
            $this->model = $this->model->where('people_film_category_id', $request->operator_id);
        }
        return $this->model->with('operator')->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create($data)
    {
        $model = $this->model->create([
            'people_film_category_id' => $data['operator_id'],
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
            'status' => $data['status']
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->where('id', $id)->first();
        $model->update([
            'people_film-category_id' => $data['operator_id'],
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
        $model = $this->findById($id);
        if ($model){
            $model->delete();
            return true;
        }
        return false;
    }

}
