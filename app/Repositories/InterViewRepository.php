<?php


namespace App\Repositories;

use App\Models\InterView;

class InterViewRepository
{
    public function __construct()
    {
        $this->model = new InterView();
    }


    public function index()
    {
        return $this->model->where('status', true)->orderBy('id', 'desc')->paginate(20);
    }

    public function create($data)
    {

    }


}
