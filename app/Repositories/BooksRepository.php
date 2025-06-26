<?php


namespace App\Repositories;


use App\Models\Books;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\Log;

class BooksRepository extends BaseRepository
{
    use ImageUploads;

    public function __construct()
    {
        $this->model = new Books();
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
        return $this->model->with('category')->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function edit($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        try {
            $model = $this->model->create([
                'name_oz' => $data['name_oz'],
                'name_uz' => $data['name_uz'],
                'name_ru' => $data['name_ru'],
                'name_en' => $data['name_en']??null,
                'description_oz' => $data['description_oz'],
                'description_uz' => $data['description_uz'],
                'description_ru' => $data['description_ru'],
                'description_en' => $data['description_en']??null,
                'images' => $this->uploads($data['image'], 'book'),
                'status' => $data['status'],
                'files' => $this->fileUploads($data['file'], 'book'),
                'category_id' => $data['category_id'],
                'author_oz' => $data['author_oz'],
                'author_uz' => $data['author_uz'],
                'author_ru' => $data['author_ru'],
                'author_en' => $data['author_en']??null,
                'type_oz' => $data['type_oz']??null,
                'type_uz' => $data['type_uz']??null,
                'type_ru' => $data['type_ru']??null,
                'type_en' => $data['type_en']??null,
                'about_oz' => $data['about_oz'],
                'about_uz' => $data['about_uz'],
                'about_ru' => $data['about_ru'],
                'about_en' => $data['about_en']??null,
                'date' =>  $data['date'],
            ]);
            if ($model) {
                return $model;
            }
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return false;
        }
    }

    public function update($data, $id)
    {
        try {
            $model = $this->model->find($id);
            if (isset($data['image']) && !empty($data['image'])) {
                if ($model->images) {
                    deleteImages($model->images, 'book');
                }
                $images = $this->uploads($data['image'], 'book');
            } else {
                $images = $model->images;
            }
            if (isset($data['file']) && !empty($data['file'])) {
                if ($model->files) {
                    @unlink(public_path('files/book/') . $model->files);
                }
                $files = $this->fileUploads($data['file'], 'book');
            } else {
                $files = $model->files;
            }
            $model->update([
                'name_oz' => $data['name_oz'],
                'name_uz' => $data['name_uz'],
                'name_ru' => $data['name_ru'],
                'name_en' => $data['name_en']??null,
                'description_oz' => $data['description_oz'],
                'description_uz' => $data['description_uz'],
                'description_ru' => $data['description_ru'],
                'description_en' => $data['description_en']??null,
                'images' => $images,
                'status' => $data['status'],
                'files' => $files,
                'category_id' => $data['category_id'],
                'author_oz' => $data['author_oz'],
                'author_uz' => $data['author_uz'],
                'author_ru' => $data['author_ru'],
                'author_en' => $data['author_en']??null,
                'type_oz' => $data['type_oz']??null,
                'type_uz' => $data['type_uz']??null,
                'type_ru' => $data['type_ru']??null,
                'type_en' => $data['type_en']??null,
                'about_oz' => $data['about_oz'],
                'about_uz' => $data['about_uz'],
                'about_ru' => $data['about_ru'],
                'about_en' => $data['about_en']??null,
                'date' =>  $data['date'],

            ]);

            if ($model) {
                return $model;
            }

        } catch (\Exception $e) {
            Log::info('Books Errors Update:', $e->getMessage());
            return false;
        }

    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model->images) {
            deleteImages($model->images, 'book');
        }
        if ($model->files) {
            @unlink(public_path('files/book/') . $model->files);
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }

    public function download($id)
    {
        $model = $this->model->find($id);
        $file = basename($model->files);
        $path = public_path('files/book/'.$file);
        return response()->download($path);
    }
}
