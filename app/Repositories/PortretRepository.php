<?php


namespace App\Repositories;


use App\Models\Portret;
use App\Traits\ImageUploads;

class PortretRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Portret();
    }

    public function index()
    {
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {

    }

    public function create($data)
    {

    }

    public function update($data, $id)
    {

    }

    public function delete($id)
    {

    }
}
