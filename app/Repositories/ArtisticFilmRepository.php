<?php


namespace App\Repositories;

use App\Models\ArtisticFilm;

class ArtisticFilmRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new ArtisticFilm();
    }

    public function index()
    {
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
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
