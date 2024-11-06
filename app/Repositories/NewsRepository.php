<?php


namespace App\Repositories;



use App\Models\News;
use App\Traits\ImageUploads;
use Illuminate\Http\Request;

class NewsRepository extends BaseRepository
{
    use ImageUploads;
    private $model;
    public function __construct()
    {
        $this->model = new News();
    }

    public function index($request)
    {
        if (isset($request['name_oz'])&&empty($request['name_oz']))
        {
            $this->model->where('name_oz', 'like', '%'.$request['name_oz'].'%')->get();
        }
        if (isset($request['name_uz']) && empty($request['name_uz']))
        {
            $this->model->where('name_uz', 'like', '%'.$request['name_uz'].'%')->get();
        }
        if (isset($request['description_oz']) && empty($request['description_oz']))
        {
            $this->model->where('description_oz', 'like', '%'.$request['description_oz'].'%')->get();
        }
        if (isset($request['description_uz']) && empty($request['description_uz']))
        {
            $this->model->where('description_uz', 'like', '%'.$request['description_uz'].'%')->get();
        }
        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'content_oz' => $data['content_oz'],
            'content_uz' => $data['content_uz'],
            'content_ru' => $data['content_ru'],
            'content_en' => $data['content_en'],
            'status' => true,
            'images' => $this->uploads($data['photo'],'news')
        ]);
        if ($model)
        {
            return $model;
        }

        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        $model->update([
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'name_en' => $data['name_en'],
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en'],
            'content_oz' => $data['content_oz'],
            'content_uz' => $data['content_uz'],
            'content_ru' => $data['content_ru'],
            'content_en' => $data['content_en'],
            'status' => $data['status'],
            'images' => $this->uploads($data['photo'],'news')
        ]);
    }
}
