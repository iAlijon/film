<?php

namespace App\Http\Controllers;

use App\Models\Aphorism;
use App\Models\Dictionary;
use App\Models\FilmAnalysis;
use App\Models\Interview;
use App\Models\News;
use App\Models\Person;
use App\Models\Premiere;
use App\Models\TelegramUser;
use App\Telegram\Commands\StartCommand;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramController extends Controller
{
    protected $news;
    protected $premiery;
    protected $film_analysis;
    protected $aphorism;
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
            if ($message === '/start') {
                TelegramUser::updateOrCreate([
                    'telegram_id' => $update->getMessage()->getChat()->getId()
                ],[
                    'name' => $update->getMessage()->getFrom()->getFirstName(),
                    'username' => $update->getMessage()->getFrom()->getUsername()??null,
                ]);
                $keyboard = Keyboard::make()
                    ->setResizeKeyboard(true)
                    ->row(['Yangiliklar', 'Premyera'])
                    ->row(['Kino tahlil', 'Suhbatlar'])
                    ->row(['Shaxsiyat', 'Kinolug\'at'])
                    ->row(['Kinofakt', 'Filmografoya'])
                    ->row(['Kitoblar']);
                Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => 'Bo\'timizga xush kelibsiz',
                    'reply_markup' => $keyboard
                ]);
            }elseif ($message === 'Yangiliklar') {
                $news = $this->news();
                foreach ($news as $new)
                {
                    $name = $new['name_oz'];
                    $description = $new['description_oz'];
                    $content = $new['content_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span>';
                    $description = strip_tags($description, $allowed);
                    $content = strip_tags($content, $allowed);

                    $caption = <<<TEXT
                    🎬: $name
                    🆕: $description
                    $content
                    TEXT;

                    $url = explode('/', $new['image']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/news/'.$last);
                    Telegram::sendPhoto([
                        'chat_id' => $chat_id,
                        'photo' => InputFile::create($image_path),
                        'caption' => $caption,
                        'parse_mode' => 'html'
                    ]);
                }
            }elseif ($message === 'Premyera'){
                $models = Premiere::where('status', 1)->get();
                foreach ($models as $model)
                {
                    $name = $model['name_oz'];
                    $description = $model['description_oz'];
                    $content = $model['content_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span>';
                    $description = strip_tags($description, $allowed);
                    $content = strip_tags($content, $allowed);
                    $caption = <<<TEXT
                    🎬: $name
                    🆕: $description
                    $content
                    TEXT;

                    $url = explode('/', $model['images']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/premiere/'.$last);
                    Telegram::sendPhoto([
                        'chat_id' => $chat_id,
                        'photo' => InputFile::create($image_path),
                        'caption' => $caption,
                        'parse_mode' => 'HTML'
                    ]);
                }
            }elseif ($message == 'Kino tahlil')
            {
                $models = FilmAnalysis::where('status', 1)->get();
                foreach ($models as $model)
                {
                    $name = $model['name_oz'];
                    $description = $model['description_oz'];
                    $content = $model['content_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span>';
                    $description = strip_tags($description, $allowed);
                    $content = strip_tags($content, $allowed);
                    $caption = <<<TEXT
                    🎬: $name
                    🆕: $description
                    $content
                    TEXT;

                    $url = explode('/', $model['images']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/analysis/'.$last);
                    Telegram::sendPhoto([
                        'chat_id' => $chat_id,
                        'photo' => InputFile::create($image_path),
                        'caption' => $caption,
                        'parse_mode' => 'HTML'
                    ]);
                }
            }elseif ($message == 'Suhbatlar'){
                $models = Interview::where('status', 1)->with('people','category')->get();
                foreach ($models as $model)
                {
                    $name = $model['interview_oz'];
                    $description = $model['description_oz'];
                    $category_name = $model['category']['name_oz'];
                    $content = $model['content_oz'];
                    $full_name = $model['people']['full_name_oz'];
                    $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span>';
                    $description = strip_tags($description, $allowed);
                    $content = strip_tags($content, $allowed);
                    $caption = <<<TEXT
                    👤  $category_name: $full_name

                    🎬: $name
                    🆕: $description

                        $content
                    TEXT;

                    $url = explode('/', $model['people']['images']);
                    $last = array_pop($url);
                    $image_path = storage_path('app/public/interview_people/'.$last);
                    Telegram::sendPhoto([
                        'chat_id' => $chat_id,
                        'photo' => InputFile::create($image_path),
                        'caption' => $caption,
                        'parse_mode' => 'HTML'
                    ]);
                }
            }elseif ($message == 'Shaxsiyat')
            {
                $models = Person::where('status', 1)->get();
                if ($models->count() > 0)
                {
                    foreach ($models as $model)
                    {
                        $full_name = $model['full_name_oz'];
                        $birth_date = $model['birth_date'];
                        $description = $model['description_oz'];
                        $content = $model['content_oz'];
                        $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span>';
                        $description = strip_tags($description, $allowed);
                        $content = strip_tags($content, $allowed);
                        $caption = <<<TEXT
                        👤  $full_name
                        📅  $birth_date
                        🆕: $description

                            $content
                        TEXT;

                        $url = explode('/', $model['images']);
                        $last = array_pop($url);
                        $image_path = storage_path('app/public/person/'.$last);
                        Telegram::sendPhoto([
                            'chat_id' => $chat_id,
                            'photo' => InputFile::create($image_path),
                            'caption' => $caption,
                            'parse_mode' => 'HTML'
                        ]);
                    }
                }else{
                    function centerLine(string $text, int $width = 30): string {
                        $len = mb_strlen($text);
                        $pad = max(0, intdiv($width - $len, 2));
                        return str_repeat(' ', $pad) . $text;
                    }
                    $line = centerLine('Bu menuda ma\'lumot topilmadi', 30);
                    Telegram::sendMessage([
                       'chat_id' => $chat_id,
                       'text' => "<pre>$line</pre>",
                       'parse_mode' => 'HTML'
                    ]);
                }
            }elseif ($message == 'Kinolug\'at')
            {
                $client = new \GuzzleHttp\Client(['varefy' => false]);
                $res = $client->get('https://kino-tahlil.uz/api/letters_category');
                $items = json_decode($res->getBody()->getContents(), true);
                Log::info($items);
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
                $rows[] = ['◀️ Ortga'];
                $keyboard = Keyboard::make([
                    'keyboard' => $rows,
                    'resize_keyboard' => true,
                ]);
                Telegram::sendMessage([
                   'chat_id' => $chat_id,
                   'text' => 'Lug\'at boycha ma\'lumotni chiqarsh',
                   'reply_markup' => $keyboard
                ]);
            }elseif ($message == '◀️ Ortga')
            {
                $keyboard = Keyboard::make()
                    ->setResizeKeyboard(true)
                    ->row(['Yangiliklar', 'Premyera'])
                    ->row(['Kino tahlil', 'Suhbatlar'])
                    ->row(['Shaxsiyat', 'Kinolug\'at'])
                    ->row(['Kinofakt', 'Filmografoya'])
                    ->row(['Kitoblar']);
                Telegram::sendMessage([
                    'chat_id' => $chat_id,
                    'text' => '✅ Asosiy Menu',
                    'reply_markup' => $keyboard
                ]);
            }
        }catch (\Exception $exception) {
            report($exception);
            Log::error('error:', [$exception->getMessage()]);
            return response($exception->getMessage());
        }
    }

    public function news()
    {
        $models = News::where('status', 1)->select('name_oz', 'description_oz', 'content_oz', 'view_count', 'image')->get();
        return $models;
    }
}
