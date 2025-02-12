<?php


namespace App\Repositories;


use App\Models\Animation;
use App\Traits\ImageUploads;

class AnimationRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Animation();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz))
        {
            $this->model->where('name_oz', 'ilike', '%'.$request->name_oz.'%');
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
            'content_oz' => contentByDomDocment($data['content_oz'], 'animation'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'animation'),
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'animation'),
        ]);
        if ($model)
        {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $item = $this->findById($id);
        if ($item->images)
        {
            deleteImages($item->images, 'animation');
        }
        $item->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'animation'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'animation'),
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'animation'),
        ]);
    }

    public function delete($id)
    {
        $item = $this->findById($id);
        if ($item->images)
        {
            deleteImages($item->images, 'animation');
        }
        if ($item->delete())
        {
            return true;
        }
        return false;
    }
}
