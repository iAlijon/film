<?php


namespace App\Repositories;


use App\Models\Premiere;
use App\Traits\ImageUploads;

class PremiereRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Premiere();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz)) {
            $this->model = $this->model->where('name_oz', 'ilike', '%' . $request->name_oz . '%');
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        return $this->model->with('category')->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
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
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'premiere'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'premiere'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'premiere'),
            'content_en' => contentByDomDocment($data['content_en'], 'premiere')??null,
            'images' => $this->uploads($data['image'], 'premiere'),
            'status' => $data['status'],
        ]);
        return $model;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($model->images) {
                deleteImages($model->images, 'premiere');
            }
            $images = $this->uploads($data['image'], 'premiere');
        }else {
            $images = $model->images;
        }
        $model->update([
            'category_id' => $data['category_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'content_oz' => contentByDomDocment($data['content_oz'], 'premiere'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'premiere'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'premiere'),
            'content_en' => contentByDomDocment($data['content_en'], 'premiere')??null,
            'images' => $images,
            'status' => $data['status']
        ]);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->images) {
            deleteImages($model->images, 'premiere');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
