<?php
namespace App\Repositories;


use App\Models\Calendar;

class CalendarRepository extends \App\Repositories\BaseRepository
{

    public function __construct()
    {
        $this->model = new Calendar();
    }

    public function index($request)
    {
        $lang = $request['translates'] ?? 'oz';
        if (isset($request->date) && !empty($request->date))
        {
            $date = $request->date;
            $this->model = $this->model->where('date', $date);
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

    public function findById($id, $translates = null)
    {
        return $this->model->with(['translates' => function ($q) use ($translates){
            $q->where('translates', $translates);
        }])->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'date' => $data['date'],
            'status' => $data['status'],
            'order' => $data['order']
        ]);

        $model->translates()->updateOrCreate([
            'translates' => $data['translates']
        ],[
            'description' => $data['description'],
        ]);

        if ($model)
        {
            return $model;
        }
        return null;
    }

    public function update($data, $id)
    {
        $model = $this->model->with(['translates'])->findOrFail($id);
        $model->update([
            'date' => $data['date'],
            'status' => $data['status'],
            'order' => $data['order']
        ]);

        $model->translates()->updateOrCreate([
            'translates' => $data['translates']
        ],[
            'description' => $data['description']
        ]);

        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        if ($model->delete())
        {
            return true;
        }else{
            return false;
        }

    }


}
