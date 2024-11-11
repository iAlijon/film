<?php


namespace App\Http\Filter;


use App\Models\Director;
use Illuminate\Http\Request;

class DirectorFilter
{
    private $request;
    private $model;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new Director();
    }

    public function filter()
    {
        if (isset($this->request->full_name_oz) && !empty($this->request->full_name_oz)) {
            $this->model = $this->model->where('full_name_oz', 'like', '%' . $this->model->full_name_oz . '%');
        }
        if (isset($this->request->description_oz) && !empty($this->request->description_oz)) {
            $this->model = $this->model->where('description_oz', 'like', '%' . $this->request->description_oz . '%');
        }
        if (isset($this->request->birth_date) && !empty($this->request->birth_date)){
            $this->model = $this->model->where('birth_date', 'like', '%'.$this->request->birth_date.'%');
        }

        return $this->model;
    }


}

