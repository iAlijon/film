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
            $this->model->where('name_oz', 'ilike', '%' . $request->name_oz . '%');
        }

        if (isset($request->analysis_category_id) && !empty($request->analysis_category_id)) {
            $this->model->where('analysis_category_id', $request->analysis_category_id);
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
            'analysis_category' => $data['analysis_category_id'],
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
        if ($item->images)
        {
            deleteImages($item->images, 'analysis');
        }
        $model = $item->update([
            'analysis_category' => $data['analysis_category'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'analysis'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'analysis'),
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'analysis')
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
