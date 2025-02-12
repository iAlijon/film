<?php


namespace App\Repositories;


use App\Models\PeopleAssociatedWithTheFilmCategory;

class InterviewCategoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new PeopleAssociatedWithTheFilmCategory();
    }

    public function index()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
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
            'status' => $data['status']
        ]);
        if ($model) {
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
