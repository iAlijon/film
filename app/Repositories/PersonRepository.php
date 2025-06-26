<?php


namespace App\Repositories;


use App\Models\Person;
use App\Traits\ImageUploads;

class PersonRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Person();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function index($request)
    {
        if (isset($request->full_name_oz) && !empty($request->full_name_oz)) {
            $this->model = $this->model->where('full_name_oz', 'ilike', '%'.$request->full_name_oz.'%');
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        return $this->model->with('category')->orderBy('created_at', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function create($data)
    {
        $model = $this->model->create([
            'category_id' => $data['category_id'],
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru'],
            'full_name_en' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'person'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'person'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'person'),
            'content_en' => contentByDomDocment($data['content_en'], 'person')??null,
            'status' => $data['status'],
            'images' => $this->uploads($data['image'], 'person'),
            'birth_date' => $data['birth_date']
        ]);

        if ($model) {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if (isset($data['images']) && !empty($data['images'])) {
            if ($model->images) {
                deleteImages($model->images, 'person');
            }
            $images = $this->uploads($data['image'], 'person');
        }else {
            $images = $model->images;
        }
        $model->update([
            'category_id' => $data['category_id'],
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru'],
            'full_name_en' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'person'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'person'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'person'),
            'content_en' => contentByDomDocment($data['content_en'], 'person')??null,
            'status' => $data['status'],
            'images' => $images,
            'birth_date' => $data['birth_date']
        ]);
        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->iamges) {
            deleteImages($model->images, 'person');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
