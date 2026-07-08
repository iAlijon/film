<?php


namespace App\Repositories;


use App\Models\Aphorism;
use App\Models\Calendar;
use App\Traits\ImageUploads;
use Illuminate\Support\Str;

class AphorismRepository extends BaseRepository
{
    use ImageUploads;
    public function __construct()
    {
        $this->model = new Aphorism();
    }

    public function index($request)

    {
        $lang = $request['translates'] ?? 'oz';
        if (isset($request->full_name) && !empty($request->full_name))
        {
            $full_name = $request->full_name;
            $this->model = $this->model->whereHas('translations', function ($q) use ($full_name){
                $q->where('full_name', 'ilike', '%'.$full_name.'%');
            });
        }
        if (isset($request->status) && !empty($request->status)) {
            $this->model = $this->model->where('status', $request->status);
        }
        $this->model = $this->model->whereHas('translations', function ($q) use ($lang){
           $q->where('translates', $lang);
        });
        return $this->model->with(['translations' => function ($q) use ($lang) {
            $q->where('translates', $lang);
        }])->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id, $request)
    {
        $model = $this->model->whereId($id)->first();
        $model->load(['translations' => function ($q) use ($request){
           $q->where('translates', $request);
        }]);
        return $model;
    }

    public function create($data)
    {
        $model = $this->model->create([
            'slug' => Str::slug($data['full_name']),
            'images' => $this->uploads($data['image'], 'aphorism'),
            'status' => $data['status'],
            'order' => $data['order']
        ]);
        $model->translations()->create([
            'full_name' => $data['full_name'],
            'description' => $data['description'],
            'translates' => $data['translates'],
            'calendar' => $data['calendar']??null,
        ]);
        return $model;
    }

    public function update($data, $id)
    {
        $model = $this->model->whereId($id)->first();
        if (isset($data['image']) && !empty($data['image'])) {
            if ($model->images) {
                deleteImages($model->images, 'aphorism');
            }
            $images = $this->uploads($data['image'], 'aphorism' );
        }else {
            $images = $model->images;
        }

        $model->update([
            'slug' => $data['full_name'],
            'images' => $images,
            'status' => $data['status'],
            'order' => $data['order']
        ]);

        $model->translations()->updateOrCreate([
                'translates' => $data['translates'],
            ],[
               'full_name' => $data['full_name'],
               'description' => $data['description'],
//               'calendar' => $data['calendar'],

        ]);
        return $model;
    }

    public function delete($id, $translate = null)
    {
        $model = $this->model->whereId($id)->first();
        if ($model->images)
        {
            deleteImages($model->images, 'aphorism');
        }
        if ($model->delete()){
            return true;
        }
        return false;
    }


}
