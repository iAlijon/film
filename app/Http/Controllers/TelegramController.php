<?php

namespace App\Http\Controllers;

use App\Models\Aphorism;
use App\Models\Books;
use App\Models\CinemaFact;
use App\Models\Dictionary;
use App\Models\FilmAnalysis;
use App\Models\FilmDictionaryCategory;
use App\Models\Filmography;
use App\Models\Interview;
use App\Models\News;
use App\Models\Person;
use App\Models\Premiere;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramController extends Controller
{
    protected $news;
    protected $premiery;
    protected $film_analysis;
    protected $aphorism;
    const url = 'https://film-front-javohirs-projects-cf013492.vercel.app/';
    public function __construct()
    {
        $this->news = new News();
        $this->premary = new Premiere();
        $this->film_analysis = new FilmAnalysis();
        $this->aphorism = new Aphorism();
    }

    public function handle()
    {
//        TElEGRAM_WEBHOOK_URL="curl -X POST "https://api.telegram.org/bot8046840365:AAH07K_oazKT7ShRmzBvcOXRiAni1Vfvy80/setWebhook" -d "url=https://d07cf021dd65.ngrok-free.app/api/telegram/webhook""
        try {
            $update = Telegram::getWebhookUpdate();
            $chat_id = $update->getMessage()->getChat()->getId();
            $message = $update->getMessage()->getText();
            $message_id = $update->getMessage()->getMessageId();
            Log::info($message_id);
            if ($message === '/start') {
                $name = $update->getMessage()->getFrom()->getFirstName();
                TelegramUser::updateOrCreate([
                    'telegram_id' => $update->getMessage()->getChat()->getId()
                ],[
                    'name' => $update->getMessage()->getFrom()->getFirstName(),
                    'username' => $update->getMessage()->getFrom()->getUsername()??null,
                    'message_id' => $update->getMessage()->getMessageId()
                ]);
                $keyboard = Keyboard::make()
                    ->setResizeKeyboard(true)
                    ->row(['Yangiliklar', 'Premyera'])
                    ->row(['Kino tahlil', 'Suhbatlar'])
                    ->row(['Shaxsiyat', 'Kinolug\'at'])
                    ->row(['Kinofakt', 'Filmografiya'])
                    ->row(['Kitoblar']);
                $this->sendMessage($chat_id,'🖐 Bo\'timizga xush kelibsiz'.' '.$name,$keyboard);
            }elseif ($message === 'Yangiliklar') {
                $models = News::where('status', 1)
                    ->select('id','name_oz', 'description_oz', 'content_oz', 'view_count', 'image')
                    ->latest()
                    ->take(5)
                    ->get();
                if (count($models) === 0){
                    $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }
                foreach ($models as $new)
                {
                    $name = $new['name_oz'];
                    $description = $new['description_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                    $description = strip_tags($description, $allowed);
                    $fixHtml = function($text) {
                        if (function_exists('tidy_repair_string')) {
                            return tidy_repair_string($text, [
                                'output-xhtml' => true,
                                'show-body-only' => true,
                                'wrap' => 0
                            ], 'utf8');
                        }
                        return $text;
                    };

                    $description = $fixHtml($description);
                    $longDesc = mb_substr($description, 0, 800);

                    $caption = <<<TEXT
                    🎬: $name
                    🆕: $longDesc
                    TEXT;
                    $url = explode('/', $new['image']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/news/'.$last);
                    $id = $new['id'];
                    $keyboard = Keyboard::make()->inline()->row([
                        Keyboard::inlineButton([
                            'text' => "🔗 Batafsil",
                            'url'  => self::url.'news/'.$id
                        ])
                    ]);
                    $this->sendPhoto($chat_id, $image_path, $caption, $keyboard);
                }
            }elseif ($message === 'Premyera'){
                $models = Premiere::where('status', 1)->orderBy('created_at', 'desc')->latest()->take(5)->get();
                if (count($models) === 0){
                    $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }
                foreach ($models as $model)
                {
                    $name = $model['name_oz'];
                    $description = $model['description_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                    $description = strip_tags($description, $allowed);
                    $caption = <<<TEXT
                    🎬: $name
                    🆕: $description
                    TEXT;

                    $url = explode('/', $model['images']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/premiere/'.$last);
                    $btn = Keyboard::inlineButton([
                        'text' => '🔗 Batafsil',
                        'url' => self::url.'premiere/'.$model['id']
                    ]);
                    $keyboard = Keyboard::make()->inline();
                    $keyboard->row([$btn]);
                    $this->sendPhoto($chat_id, $image_path, $caption, $keyboard);
                }
            }elseif ($message == 'Kino tahlil')
            {
                $models = FilmAnalysis::where('status', 1)->get();
                if (count($models) === 0){
                    $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }
                try {
                    foreach ($models as $model)
                    {
                        $name = $model['name_oz'];
                        $description = $model['description_oz'];
                        $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                        $description = strip_tags($description, $allowed);
                        $caption = <<<TEXT
                        🎬: $name
                        🆕: $description
                        TEXT;

                        $url = explode('/', $model['images']);
                        $last = array_pop($url);
                        $image_path = storage_path('app/public/analysis/'.$last);
                        $keyboard = Keyboard::make()->inline()->row([
                            Keyboard::inlineButton([
                               'text' => '🔗 Batafsil',
                               'url' => self::url.'analysis/'.$model['id']
                            ])
                        ]);
                       $this->sendPhoto($chat_id,$image_path,$caption,$keyboard);
                    }
                }catch (\Exception $exception){
                    Log::info('tahlil', [$exception->getMessage()]);
                }

            }elseif ($message == 'Suhbatlar'){
                $models = Interview::where('status', 1)->with('people','category')->get();
                if (count($models) === 0)
                {
                   $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }
                foreach ($models as $model)
                {
                    $name = $model['interview_oz'];
                    $description = $model['description_oz'];
                    $category_name = $model['category']['name_oz'];
                    $full_name = $model['people']['full_name_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                    $description = strip_tags($description, $allowed);
                    $caption = <<<TEXT
                    👤  $category_name: $full_name

                    🎬: $name
                    🆕: $description
                    TEXT;

                    $url = explode('/', $model['people']['images']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/interview_people/'.$last);
                    $keyboard = Keyboard::make()->inline()->row([
                       Keyboard::inlineButton([
                           'text' => '🔗 Batafsil',
                           'url' => self::url.'interviews/'.$model['id']
                       ])
                    ]);
                    $this->sendPhoto($chat_id,$image_path,$caption,$keyboard);
                }
            }elseif ($message == 'Shaxsiyat')
            {
                $models = Person::where('status', 1)->get();
                if (count($models) === 0){
                    $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }

                foreach ($models as $model) {
                    $full_name = $model['full_name_oz'];
                    $birth_date = $model['birth_date'];
                    $description = $model['description_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                    $description = strip_tags($description, $allowed);
                    $caption = <<<TEXT
                        👤  $full_name
                        📅  $birth_date
                        🆕: $description
                        TEXT;

                    $url = explode('/', $model['images']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/person/' . $last);
                    $keyboard = Keyboard::make()->inline()->row([
                        Keyboard::inlineButton([
                            'text' => '🔗 Batafsil',
                            'url' => self::url.'persons/'.$model['id']
                        ])
                    ]);
                    $this->sendPhoto($chat_id,$image_path,$caption,$keyboard);
                }
            }elseif ($message == 'Kinolug\'at')
            {
                $client = new \GuzzleHttp\Client(['varefy' => false]);
                $res = $client->get('https://kino-tahlil.uz/api/letters_category');
                $items = json_decode($res->getBody()->getContents(), true);
                $rows = [];
                $row = [];
                foreach ($items['data'] as $item)
                {
                    $row[] = $item['name'];
                    if (count($row) === 4) {
                        $rows[] = $row;
                        $row = [];
                    }
                }
                if (!empty($row)) {
                    $rows[] = $row;
                }
                $rows[] = ['◀️ Asosiy Menu'];
                $keyboard = Keyboard::make([
                    'keyboard' => $rows,
                    'resize_keyboard' => true,
                ]);
                $message = centerLine('Lug\'at bo\'yicha ma\'lumotni chqarish', 30);
                $this->sendMessage($chat_id,$message,$keyboard);

            }elseif ($message == '◀️ Asosiy Menu')
            {
                $keyboard = Keyboard::make()
                    ->setResizeKeyboard(true)
                    ->row(['Yangiliklar', 'Premyera'])
                    ->row(['Kino tahlil', 'Suhbatlar'])
                    ->row(['Shaxsiyat', 'Kinolug\'at'])
                    ->row(['Kinofakt', 'Filmografiya'])
                    ->row(['Kitoblar']);
                $this->sendMessage($chat_id,'✅ Asosiy Menu', $keyboard);
            }elseif (checkLetters($message)) {
                $param = $this->checkLetter($message);
                $result = FilmDictionaryCategory::where('dictionary_category_id', $param->id)->with('film_dictionary')->get();
                if (count($result) === 0) {
                    $this->NotFound($chat_id, centerLine('Bu Lug\'at bo\'yicha qidirilgan ma\'lumot topilmadi', 30));
                }
                foreach ($result as $item)
                {
                    $name = $item['film_dictionary']['name_oz'];
                    $description = $item['film_dictionary']['description_oz'];
                    $url = explode('/', $item['film_dictionary']['images']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/dictionary/'.$last);
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                    $description = strip_tags($description, $allowed);
                    $caption = <<<TEXT
                     $message: $name
                     🆕: $description
                    TEXT;
                    $keyboard = Keyboard::make()->inline()->row([
                       Keyboard::inlineButton([
                           'text' => '🔗 Batafsil',
                           'url' => self::url.'dictionary/'.$item['id']
                       ])
                    ]);
                    $this->sendPhoto($chat_id,$image_path,$caption,$keyboard);
                }

            }elseif ($message === 'Kinofakt') {
                $models = CinemaFact::where('status', 1)->get();
                if (count($models) === 0){
                    $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }
                try {
                    foreach ($models as $model) {
                        $name = $model['name_oz'];
                        $description = $model['description_oz'];
                        $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                        $description = strip_tags($description, $allowed);
                        $caption = <<<TEXT
                        🎬:  $name
                        🆕: $description
                        TEXT;

                        $url = explode('/', $model['images']);
                        $last = array_pop($url);
                        $image_path = storage_path('app/public/fact/' . $last);
                        $keyboard = Keyboard::make()->inline()->row([
                           Keyboard::inlineButton([
                               'text' => '🔗 Batafsil',
                               'url' => self::url.'facts/'.$model['id']
                           ])
                        ]);
                        $this->sendPhoto($chat_id,$image_path,$caption,$keyboard);
                    }
                }catch (\Exception $e) {
                    Log::info('fact',[$e->getMessage()]);
                }
            }elseif ($message === 'Filmografiya') {
                $models = Filmography::where('status', 1)->get();
                if (count($models) === 0){
                    $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }
                try {
                    foreach ($models as $model) {
                        $name = $model['name_oz'];
                        $description = $model['description_oz'];
                        $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                        $description = strip_tags($description, $allowed);
                        $caption = <<<TEXT
                        🎬:  $name
                        🆕: $description
                        TEXT;

                        $url = explode('/', $model['images']);
                        $last = array_pop($url);
                        $image_path = storage_path('app/public/filmography/' . $last);
                        $keyboard = Keyboard::make()->inline()->row([
                           Keyboard::inlineButton([
                               'text' => '🔗 Batafsil',
                               'url' => self::url.'filmography/'.$model['id']
                           ])
                        ]);
                        $this->sendPhoto($chat_id,$image_path,$caption,$keyboard);
                    }
                }catch (\Exception $exception)
                {
                    Log::info('Filmografiya',[$exception->getMessage()]);
                }
            }elseif ($message === 'Kitoblar') {
                $models = Books::where('status', 1)->get();
                if (count($models) === 0) {
                    $this->NotFound($chat_id, centerLine('Bu menu da ma\'lumot topilmadi', 30));
                }
                try {
                    foreach ($models as $model) {
                        $name = $model['name_oz'];
                        $author = $model['author_oz'];
                        $description = $model['description_oz'];
                        $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span class="tg-spoiler">';
                        $description = strip_tags($description, $allowed);
                        $longDesc = mb_substr($description, 0, 800);
                        $file = $model->files;
                        $caption = <<<TEXT
                          📚   $name
                          ✍️ $author

                          🎬   $longDesc
                        TEXT;
                        $keyboard = Keyboard::make()->inline()->row([
                           Keyboard::inlineButton([
                               'text' => '🔗 Batafsil',
                               'url' => self::url.'books/'.$model['id']
                           ])
                        ]);
                        $this->sendDocument($chat_id,$file,$caption,$keyboard);

                    }
                }catch (\Exception $exception) {
                    Log::error('Kitoblar',[$exception->getMessage()]);
                }
            }elseif (!checkMessage($message)) {

                Telegram::deleteMessage([
                    'message_id' => $message_id,
                    'chat_id' => $chat_id
                ]);
                $sent = Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => $message,
                ]);

                $newMsgId = $sent->getMessageId();
                $frames = [];
                $len = mb_strlen($message);

                for ($i = $len; $i >= 1; $i--) {
                    $frames[] = mb_substr($message, 0, $i) . " ‎";
                }
                $frames[] = "💨";
                $frames[] = "✅ O‘chirildi";

                foreach ($frames as $frame) {
                    usleep(300000);
                    Telegram::editMessageText([
                        'chat_id' => $chat_id,
                        'message_id' => $newMsgId,
                        'text' => $frame,
                    ]);
                }

                sleep(1);
                Telegram::deleteMessage([
                    'chat_id' => $chat_id,
                    'message_id' => $newMsgId,
                ]);
            }
        }catch (\Exception $exception) {
            report($exception);
            Log::error('error:', [$exception->getMessage()]);
            return response($exception->getMessage());
        }
    }


    public function checkLetter($letter)
    {
        $result = Dictionary::whereJsonContains('name_oz->upper', $letter)->get();
        Log::info(!empty($result));
        if (!empty($result)) {
            return $result[0];
        }else {
            return false;
        }

    }

    public function NotFound($chat_id,$text)
    {
        Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => "<pre>$text</pre>",
            'parse_mode' => 'HTML'
        ]);
    }

    public function sendMessage($chat_id, $message = null,$keyboard = null)
    {
        Telegram::sendMessage([
           'chat_id' => $chat_id,
           'text' => $message,
           'reply_markup' => $keyboard,
           'parse_mode' => 'HTML'
        ]);
    }

    public function sendPhoto($chat_id, $photo,$message, $keyboard)
    {
        Telegram::sendPhoto([
            'chat_id' => $chat_id,
            'photo' => InputFile::create($photo),
            'caption' => $message,
            'reply_markup' => $keyboard,
            'parse_mode' => 'HTML'
        ]);
    }

    public function sendDocument($chat_id,$file,$message,$keyboard)
    {
        Telegram::sendDocument([
            'chat_id' => $chat_id,
            'document' => InputFile::create($file),
            'caption' => $message,
            'reply_markup' => $keyboard,
            'parse_mode' => 'HTML'
        ]);
    }
}
