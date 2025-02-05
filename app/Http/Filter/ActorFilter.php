<?php


namespace App\Http\Filter;


use App\Models\Actor;
use Illuminate\Http\Request;

class ActorFilter
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new Actor();
    }

    public function filter()
    {
        if (isset($this->request->full_name_oz) && !empty($this->request->full_name_oz))
        {
            $this->model = $this->model->where('full_name_oz', 'ilike', '%'.$this->request->full_name_oz.'%');
        }
        return $this->model;
    }

}
