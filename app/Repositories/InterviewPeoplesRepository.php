<?php


namespace App\Repositories;


use App\Models\InterviewPeoples;
use App\Traits\ImageUploads;

class InterviewPeoplesRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new InterviewPeoples();
    }

    public function index($request)
    {
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->full_name_oz) && !empty($request->full_name_oz)) {
            $this->model = $this->model->where('full_name_oz', 'ilike', '%'.$request->full_name_oz.'%');
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        return $this->model->with('category')->orderBy('created_at', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'category_id' => $data['category_id'],
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'images' => $this->uploads($data['image'], 'interview_people'),
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'status' => $data['status']
        ]);

        if ($model) {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if ($model->images) {
            deleteImages($model->images, 'interview_people');
        }
        $model->update([
            'category_id' => $data['category_id'],
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'images' => $this->uploads($data['image'], 'interview_people'),
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'status' => $data['status']
        ]);

        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->images) {
            deleteImages($model->images, 'interview_people');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
