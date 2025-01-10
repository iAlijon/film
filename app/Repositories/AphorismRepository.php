<?php


namespace App\Repositories;


use App\Models\Aphorism;
use App\Models\Calendar;
use App\Traits\ImageUploads;

class AphorismRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Aphorism();
    }

    public function index($request)
    {
        if (isset($request->title) && !empty($request->title))
        {
            $this->model = $this->model->where('title', 'like', '%'.$request->title.'%');
        }
        return $this->model->with('calendar')->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'images' => $this->uploads($data['image'], 'aphorism'),
            'status' => $data['status']
        ]);
        foreach ($data['calendar'] as $datum)
        {
            Calendar::create([
                'aphorism_id' => $model->id,
                'description_oz' => $datum['description_oz']??null,
                'description_uz' => $datum['description_uz']??null,
            ]);
        }
        return $model;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if ($model->images)
        {
            deleteImages($model->images, 'aphorism');

        }
        $model->update([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'images' => $this->uploads($data['image'], 'aphorism'),
            'status' => $data['status']
        ]);
        $items = Calendar::where('aphorism_id', $model->id)->get();
        foreach ($items as $item)
        {
            $item->delete();
        }
        foreach ($data['calendar'] as $datum)
        {
            Calendar::create([
                'aphorism_id' => $model->id,
                'description_oz' => $datum['description_oz'],
                'description_uz' => $datum['description_uz'],
            ]);
        }
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        $items = Calendar::where('aphorism', $model->id)->get();
        if ($model->images)
        {
            deleteImages($model->images, 'aphorism');
        }
        foreach ($items as $item) {
            $item->delete();
        }
        if ($model->delete()){
            return true;
        }
        return false;
    }


}
