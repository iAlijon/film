<?php


namespace App\Repositories;


use App\Models\Books;
use App\Traits\ImageUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BooksRepository extends BaseRepository
{
    use ImageUploads;

    public function __construct()
    {
        $this->model = new Books();
    }

    public function index($request)
    {
        if (isset($request->name) && !empty($request->name)) {
            $name = $request->name;
            $this->model = $this->model->whereHas('translates', function ($q) use ($name){
              $q->where('name', 'ilike', '%'.$name.'%');
            });
        }

        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }

        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        $lang = $request->translates ?? 'oz';
        $this->model = $this->model->whereHas('translates', function ($q) use ($lang){
            $q->where('translates', $lang);
        });

        return $this->model->with(['category.translates' => function ($q) use ($lang){
            $q->where('translates', $lang);
        },
            'translates' => function ($q) use ($lang) {
                $q->where('translates', $lang);
            }
        ])->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function edit($id, $request)
    {
        $lang = $request->translates ?? 'oz';
        return $this->model->with(['translates' => function ($q) use ($lang){
            $q->where('translates', $lang);
        }])->find($id);
    }

    public function create($data)
    {
        try {
            $model = $this->model->create([
                'status' => $data['status'],
                'category_id' => $data['category_id'],
                'order' => $data['order'],
                'slug' => Str::slug($data['name']),
                'width_ratio' => $data['width_ratio'] ?? 16,
                'height_ratio' => $data['height_ratio'] ?? 9,
            ]);
            $model->translates()->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'images' => $this->uploads($data['image'], 'book'),
                'files' => $this->fileUploads($data['file'], 'book'),
                'author' => $data['author'],
                'about' => $data['about'],
                'date' =>  $data['date'],
                'translates' => $data['translates'],
                'book_id' => $model->id
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
            $model = $this->model->findOrFail($id);
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
                'status' => $data['status'],
                'category_id' => $data['category_id'],
                'slug' => $data['name'],
                'order' => $data['order'],
                'width_ratio' => $data['width_ratio'] ?? 16,
                'height_ratio' => $data['height_ratio'] ?? 9,
            ]);

            $model->translates()->updateOrCreate([
                'translates' => $data['translates'],
                ],[
                'name' => $data['name'],
                'description' => $data['description'],
                'images' => $images,
                'files' => $files,
                'author' => $data['author'],
                'about' => $data['about'],
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
        $model = $this->model->with('translates')->find($id);
        $file = basename($model->translates->first()->files);
        $path = public_path('files/book/'.$file);
        return response()->download($path);
    }
}
