<?php


namespace App\Repositories;


use App\Models\Director;

class DirectorRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Director();
    }

    public function index($request)
    {

    }
}
