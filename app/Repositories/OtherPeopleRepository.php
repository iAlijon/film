<?php


namespace App\Repositories;


use App\Models\OtherPeople;

class OtherPeopleRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model = new OtherPeople();
    }

    public function index($request)
    {
        if (isset($request->full_name_oz) && !empty($request->full_name_oz))
        {
            $this->model = $this->model->where('name_oz', 'like', '%'.$request->full_name_oz.'%');
        }
        return $this->model->with('other')->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create($data)
    {
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
            'people_film_category_id' => $data['other_id'],
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
        $model = $this->findById($id);
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
            'people_film_category_id' => $data['other_id'],
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
        if ($model->delete())
        {
            return true;
        }
        return false;
    }

}
