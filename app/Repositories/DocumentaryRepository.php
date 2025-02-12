<?php


namespace App\Repositories;


use App\Models\Documentary;
use App\Traits\ImageUploads;

class DocumentaryRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Documentary();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz))
        {
            $this->model->where('name_oz', 'ilike','%'.$request->name_oz.'%');
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
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
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'documentary'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'documentary'),
            'images' => $this->uploads($data['image'], 'documentary'),
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
        if ($model->images)
        {
            deleteImages($model->images, 'documentary');
        }
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'documentary'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'documentary'),
            'images' => $this->uploads($data['image'], 'documentary'),
            'status' => $data['status'],
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->images){
            deleteImages($model->images, 'documentary');
        }
        if ($model->delete())
        {
            return true;
        }
        return false;
    }
}
