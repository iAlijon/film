<?php


namespace App\Http\Filter;


use App\Models\ActorConversation;
use Illuminate\Http\Request;

class ActorConversationFilter
{
    protected $request;
    protected $model;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model = new ActorConversation();
    }

    public function filter()
    {
        if (isset($this->request->full_name_oz) && !empty($this->request->full_name_oz))
        {
            $full_name_oz = $this->request->full_name_oz;
            $this->model = $this->model->whereHas('actor', function ($q) use ($full_name_oz){
                $q->where('full_name_oz', 'ilike', '%'.$full_name_oz.'%');
            });
        }

        if (isset($this->request->description_oz) && !empty($this->request->description_oz))
        {
            $this->model = $this->model->where('description_oz', 'ilike', '%'.$this->request->description_oz.'%');
        }

        return $this->model;
    }
}
