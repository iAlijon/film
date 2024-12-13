<?php


namespace App\Repositories;


use App\Models\PopularScienceFilm;

class PopularScienceFilmRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model = new PopularScienceFilm();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz))
        {
            $this->model->where('name_oz', 'ilike' ,'%'.$request->name_oz.'%');
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
//        $model = $this->model->create([
//            'name_oz' => $data['name_oz'],
//            'name_uz' => $data['name_uz'],
//            'description_oz' => $data['description_oz'],
//            'description_uz' => $data['description_uz'],
//            'content_oz' => contentByDomDocment($data['content_oz'], 'popular_science_film'),
//            'content_uz' => contentByDomDocment($data['content_uz'], 'popular_science_film'),
//            'images' => $this->uploads($data['image'], 'popular_science_film'),
//            'status' => $data['status'],
//        ]);
//        if ($model)
//        {
//            return $model;
//        }
        return false;
    }

    public function update($data, $id)
    {
        $item = $this->findById($id);
        if ($item->images)
        {
            deleteImages($item->images, 'popular_science_film');
        }
        $item->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'popular_science_film'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'popular_science_film'),
            'images' => $this->uploads($data['image'], 'popular_science_film'),
            'status' => $data['status'],
        ]);
        if ($item)
        {
            return $item;
        }
        return false;
    }

    public function delete($id)
    {
        $item = $this->findById($id);
        if ($item->images)
        {
            deleteImages($item->images, 'popular_science_film');
        }
        if ($item->delete())
        {
            return true;
        }
        return false;
    }

}
