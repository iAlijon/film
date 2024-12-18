<?php


namespace App\Repositories;


use App\Models\Books;
use App\Traits\ImageUploads;

class BooksRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Books();
    }

    public function index($request)
    {
        if (isset($request->name_oz) && !empty($request->name_oz)){
            $this->model = $this->model->where('name_oz', 'ilike', '%'.$request->name_oz.'%');
        }

        return $this->model->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function edit($id)
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
             'content_oz' => contentByDomDocment($data['content_oz'], 'book'),
             'content_uz' => contentByDomDocment($data['content_uz'], 'book'),
             'images' => $this->uploads($data['image'], 'book'),
             'status' => $data['status'],
             'files' => $this->fileUploads($data['file'], 'book'),
             'book_category' => $data['book_category']
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
        if ($model->images)
        {
            deleteImages($model->images,'book');
        }

    }

    public function download($id)
    {
        $model = $this->model->find($id);
        if ($model->files){
            $file_path = public_path('/files/book/'.$model->files);
            return response()->download($file_path);
        }
    }
}
