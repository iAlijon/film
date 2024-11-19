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
        if (isset($request->full_name_oz) && !empty($request->full_name_oz)){
            $this->model = $this->model->where('full_name_oz', 'ilike', '%'.$request->full_name_oz.'%');
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

}
