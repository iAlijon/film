<?php


namespace App\Repositories;

use App\Models\PersonCategory;

class PersonCategoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new PersonCategory();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz)) {
            $this->model = $this->model->where('name_oz', 'ilike','%'.$request->name_oz.'%');
        }
        return $this->model->orderBy('created_at', 'desc')->paginate($this->limit);
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
            'menu' => $data['menu'],
            'status' => $data['status'],
        ]);
        if ($model) {
            return $model;
        }
        return  false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'menu' => $data['menu'],
            'status' => $data['status'],
        ]);
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
