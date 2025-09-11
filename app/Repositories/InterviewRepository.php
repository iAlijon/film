<?php


namespace App\Repositories;


use App\Models\Interview;
use App\Models\PeopleAssociatedWithTheFilmCategory;
use App\Models\TelegramUser;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;

class InterviewRepository extends BaseRepository
{
    use TelegramMessage;
    public function __construct()
    {
        $this->model = new Interview();
    }

    public function index($request)
    {
        if (isset($request->interview_oz) && !empty($request->interview_oz)) {
            $this->model = $this->model->where('interview_oz', 'ilike', '%'.$request->interview_oz.'%');
        }
        if (isset($request->category_id) && !empty($request->category_id)) {
            $this->model = $this->model->where('category_id', $request->category_id);
        }
        if (isset($request->people_id) && !empty($request->people_id)) {
            $this->model = $this->model->where('interview_people_id', $request->people_id);
        }
        return $this->model->with('category', 'people')->orderBy('created_at', 'desc')->paginate($this->limit);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'category_id' => $data['category_id'],
            'interview_people_id' => $data['interview_people_id'],
            'interview_oz' => $data['interview_oz'],
            'interview_uz' => $data['interview_uz'],
            'interview_ru' => $data['interview_ru'],
            'interview_en' => $data['interview_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'interview'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'interview'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'interview'),
            'content_en' => contentByDomDocment($data['content_en'], 'interview'),
            'anchor' => null,
            'status' => $data['status'],
            'telegram_status' => $data['telegram_status']
        ]);

        if ($model->telegram_status) {
            try {
                $url = explode('/', $model->people->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/interview_people/'.$last);
                $full_name_oz = $model->people->full_name_oz;
                $caption = <<<TEXT
                👤: $full_name_oz

                    $model->interview_oz

                    $model->description_oz
                TEXT;
                $keyboard = Keyboard::make()->inline()->row([
                    Keyboard::inlineButton([
                        'text' => '🔗 Batafsil',
                        'url' => "https://film-front-javohirs-projects-cf013492.vercel.app/interview/{$model->id}"
                    ])
                ]);
                $users = TelegramUser::all();
                foreach ($users as $user) {
                    $this->sendPhoto($user->telegram_id,$image_path,$caption,$keyboard);
                }

            }catch (\Exception $exception) {
                Log::info('interview: ', [$exception->getMessage()]);
            }
        }

        if ($model) {
            return $model;
        }
        return false;
    }

    public function update($data, $id)
    {
        $model = $this->findById($id);
        $model->update([
            'category_id' => $data['category_id'],
            'interview_people_id' => $data['interview_people_id'],
            'interview_oz' => $data['interview_oz'],
            'interview_uz' => $data['interview_uz'],
            'interview_ru' => $data['interview_ru'],
            'interview_en' => $data['interview_en']??null,
            'description_oz' => $data['description_oz'],
            'description_uz' => $data['description_uz'],
            'description_ru' => $data['description_ru'],
            'description_en' => $data['description_en']??null,
            'content_oz' => contentByDomDocment($data['content_oz'], 'interview'),
            'content_uz' => contentByDomDocment($data['content_uz'], 'interview'),
            'content_ru' => contentByDomDocment($data['content_ru'], 'interview'),
            'content_en' => contentByDomDocment($data['content_en'], 'interview'),
            'status' => $data['status'],
            'telegram_status' => $data['telegram_status']
        ]);
        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->findById($id);
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
