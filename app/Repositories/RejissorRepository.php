<?php


namespace App\Repositories;


use App\Models\Rejissor;

class RejissorRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Rejissor();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz))
        {
            $this->model = $this->model->where('name_oz', 'ilike', '%'.$request->name_oz.'%');
        }
        return $this->model->with('director')->orderBy('id', 'desc')->paginate($this->limit);
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
            'content_oz' => contentByDomDocment($data['content_oz'], 'rejissor'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'rejissor'),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'status' => $data['status'],
            'people_film_category_id' => $data['director_id']
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru']??null,
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'rejissor'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'rejissor'),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'status' => $data['status'],
            'people_film_category_id' => $data['director_id']
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $this->model->find($id)->delete();
        return true;
    }
}
