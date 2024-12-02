<?php


namespace App\Repositories;


use App\Models\PortretRejissor;
use App\Traits\ImageUploads;

class PortretRejissorsRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new PortretRejissor();
    }

    public function index($request)
    {
        if (isset($request->full_name_oz) && !empty($request->full_name_oz))
        {
            $this->model = $this->model->where('full_name_oz', 'ilike', '%'.$request->full_name_oz.'%');
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create($data)
    {
        $model = $this->model->create([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru']??null,
            'full_name_en' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'images' => $this->uploads($data['image'], 'portret_rejissor'),
            'birth_date' => $data['birth_date'],
            'content_oz' => $data['content_oz'],
            'content_uz' => $data['content_uz'],
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'status' => $data['status'],
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
            deleteImages($model->images, 'portret_rejissor');
        }
        $model->update([
            'full_name_oz' => $data['full_name_oz'],
            'full_name_uz' => $data['full_name_uz'],
            'full_name_ru' => $data['full_name_ru']??null,
            'full_name_en' => $data['full_name_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'images' => $this->uploads($data['image'], 'portret_rejissor'),
            'birth_date' => $data['birth_date'],
            'content_oz' => $data['content_oz'],
            'content_uz' => $data['content_uz'],
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'status' => $data['status']
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
       if ($model)
       {
           deleteImages($model->images, 'portret_rejissor');
       }
       if($model->delete()){
           return true;
       }
       return false;
    }

}
