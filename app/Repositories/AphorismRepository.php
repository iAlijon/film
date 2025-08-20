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
        if (isset($request->full_name_oz) && !empty($request->full_name_oz))
        {
            $this->model = $this->model->where('full_name_oz', 'like', '%'.$request->full_name_oz.'%');
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        return $this->model->with('calendar')->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
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
            'full_name_ru' => $data['full_name_ru'],
            'full_name_en' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'images' => $this->uploads($data['image'], 'aphorism'),
            'status' => $data['status']
        ]);
        foreach ($data['calendar'] as $datum)
        {
            Calendar::create([
                'aphorism_id' => $model->id,
                'description_oz' => $datum['description_oz']??null,
                'description_uz' => $datum['description_uz']??null,
                'description_ru' => $datum['description_ru']??null,
                'description_en' => $datum['description_en']??null,
            ]);
        }
        return $model;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($model->images) {
                deleteImages($model->images, 'aphorism');
            }
            $images = $this->uploads($data['image'], 'aphorism');
        }else {
            $images = $model->images;
        }
        $model->update([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru'],
            'full_name_en' => $data['full_name_en'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'images' => $images,
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
                'description_ru' => $datum['description_ru'],
                'description_en' => $datum['description_en'],
            ]);
        }
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->images)
        {
            deleteImages($model->images, 'aphorism');
        }
        $items = Calendar::where('aphorism_id', $model->id)->get();
        foreach ($items as $item) {
            $item->delete();
        }
        if ($model->delete()){
            return true;
        }
        return false;
    }


}
