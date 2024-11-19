<?php


namespace App\Repositories;


use App\Http\Filter\ActorConversationFilter;
use App\Models\ActorConversation;
use App\Repositories\BaseRepository;

class ActorConversationRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new ActorConversation();
    }

    public function index($request)
    {
        $filter = new ActorConversationFilter($request);
        $filter = $filter->filter();
        return $filter->with('actor')->orderBy('id', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'actor_id' => $data['actor_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'] ?? null,
            'name_en' => $data['name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'status' => $data['data'],
        ]);
        if ($model){
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->model->find($id);
        $model->update([
            'actor_id' => $data['actor_id'],
            'name_oz' => $data['name_oz'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'] ?? null,
            'name_en' => $data['name_en'] ?? null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru']??null,
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz']),
            'content_uz' => contentByDomDocment($data['content_uz']),
            'content_ru' => $data['content_ru']??null,
            'content_en' => $data['content_en']??null,
            'status' => $data['data'],
        ]);
        if ($model){
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        return true;
    }

}
