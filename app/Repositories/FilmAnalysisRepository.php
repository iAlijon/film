<?php


namespace App\Repositories;


use App\Models\FilmAnalysis;
use App\Traits\ImageUploads;

class FilmAnalysisRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new FilmAnalysis();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz)) {
            $this->model = $this->model->where('name_oz', 'ilike', '%' . $request->name_oz . '%');
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
           $this->model =  $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }

        return $this->model->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'category_id' => $data['category_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'analysis'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'analysis'),
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'analysis'),
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $item = $this->model->find($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($item->images)
            {
                deleteImages($item->images, 'analysis');
            }
            $images = $this->uploads($data['image'], 'analysis');
        }else {
            $images = $item->images;
        }
        $model = $item->update([
            'category_id' => $data['category_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'analysis'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'analysis'),
            'status' => $data['status'],
            'images' => $images
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
        if ($model->images)
        {
            deleteImages($model->images, 'analysis');
        }
        if ($model->delete())
        {
            return true;
        }
        return false;
    }

}
