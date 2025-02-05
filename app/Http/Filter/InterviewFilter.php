<?php


namespace App\Http\Filter;


use App\Models\InterView;
use Illuminate\Http\Request;


class InterviewFilter
{
    private $request;
    private $model;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new InterView();
    }

    public function filter()
    {
        if (isset($this->request->name_oz) && !empty($this->request->name_oz)){
            $this->model = $this->model->where('name_oz', 'ilike', '%'.$this->request->name_oz.'%');
        }
        if (isset($this->request->description_oz) && !empty($this->request->desciption_oz)){
            $this->model = $this->model->where('description_oz', 'ilike', '%'.$this->model->description_oz.'%');
        }

        return $this->model;
    }
}
