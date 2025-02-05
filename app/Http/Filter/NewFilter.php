<?php


namespace App\Http\Filter;


use App\Models\News;
use Illuminate\Http\Request;

class NewFilter
{
    private $request;
    private $news;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->news = new News();
    }

    public function filter()
    {
        if (isset($this->request['name_oz']) && !empty($this->request['name_oz'])) {
            $this->news = $this->news->where('name_oz', 'ilike', '%' . $this->request['name_oz'] . '%');
        }

        if (isset($this->request['description_oz']) && !empty($this->request['description_oz'])) {
            $this->news = $this->news->where('description_oz', 'ilike', '%' . $this->request['description_oz'] . '%');
        }

        if (isset($this->request['new_category_id']) && !empty($this->request['new_category_id'])) {
            $this->news = $this->news->where('category_id', $this->request['new_category_id']);
        }
        return $this->news;
    }

}
