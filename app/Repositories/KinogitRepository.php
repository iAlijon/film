<?php

namespace App\Repositories;

use App\Models\Kinogit;
use App\Traits\ImageUploads;
use Illuminate\Support\Str;

class KinogitRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Kinogit();
    }

    public function index($request)
    {
        $lang = $request['translates'] ?? 'oz';

        if (isset($request->full_name) && !empty($request->full_name))
        {
            $full_name = $request->full_name;
            $this->model = $this->model->whereHas('translates', function ($q) use ($full_name){
                $q->where('full_name', 'ilike', '%'.$full_name.'%');
            });
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        $this->model = $this->model->whereHas('translates', function ($q) use ($lang){
            $q->where('translates', $lang);
        });
        return $this->model->with(['translates' => function ($q) use ($lang) {
            $q->where('translates', $lang);
        }])->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'slug' => Str::slug($data['name']),
            'status' => $data['status'],
            'order' => $data['order'],
            'category_id' => $data['category_id'],
            'width_ratio' => $data['width_ratio'] ?? 16,
            'height_ratio' => $data['height_ratio'] ?? 9,
        ]);

        $model->translates()->updateOrCreate([
            'translates' => $data['translates']
            ],[
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => contentByDomDocment($data['content'], 'kinogit'),
            'image' => $this->uploads($data['image'], 'kinogit'),
            'creatorRoles' => $data['creatorRoles']
        ]);

        if ($model)
        {
            return $model;
        }
        return null;
    }

    public function findById($id, $translates)
    {
        return $this->model->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->find($id);
    }

    public function update($data, $id)
    {
        $item = $this->model->with('translates')->findOrFail($id);
        if (isset($data['image']) && !empty($data['image'])) {
            if ($item->images) {
                deleteImages($item->images, 'kinogit');
            }
            $images = $this->uploads($data['image'], 'kinogit');
        } else {
            $images = $item->translates->first()->image;
        }
        $item->update([
            'category_id' => $data['category_id'],
            'status' => $data['status'],
            'order' => $data['order'],
//            'telegram_status' => isset($data['telegram_status']) ? $data['telegram_status'] : false,
            'slug' => Str::slug($data['name']),
            'width_ratio' => $data['width_ratio'] ?? 16,
            'height_ratio' => $data['height_ratio'] ?? 9,
        ]);

        $item->translates()->updateOrCreate([
            'translates' => $data['translates']
        ],[
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => contentByDomDocment($data['content'], 'kinogit'),
            'image' => $images,
            'creatorRoles' => $data['creatorRoles']
        ]);

        if ($item) {
            return $item;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model->images) {
            deleteImages($model->images, 'kinogit');
        }
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
