<?php


namespace App\Repositories;


use App\Models\FilmographyGroup;

class FilmographyGroupRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new FilmographyGroup();
    }

    public function index()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
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
            'status' => $data['status'],
        ]);
        if ($model) {
            return $data;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'status' => $data['status'],
        ]);
        if ($model) {
            return $data;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
