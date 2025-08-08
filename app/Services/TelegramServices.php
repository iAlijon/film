<?php
namespace App\Services;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\FileUpload\InputFile;

class TelegramServices
{
    public function sendToTelegram($data)
    {
        try {
            $token = env('TELEGRAM_BOT_TOKEN');
            $url = explode('/', $data->image);
            $last = array_pop($url);
            $image_path = storage_path('app/public/news/'.$last);
            $name = $data['name_oz'];
            $description = $data['description_oz'];
            $content = $data['content_oz'];
            $allowed = '<b><i><u><s><a><code><pre><strong><em><del><span>';
            $description = strip_tags($description, $allowed);
            $content = strip_tags($content, $allowed);
            $caption = <<<TEXT
            🎬: $name
            🆕: $description
                $content
            TEXT;
            $telegram = new Api($token);
            $users = TelegramUser::all();
            try {
                $telegram->sendPhoto([
                    'chat_id' => 549249454,
                    'photo' => InputFile::create($image_path),
                    'caption' => $caption,
                    'parse_mode' => 'html'
                ]);
            }catch (\Exception $e)
            {
                Log::info($e->getMessage());
            }
//            foreach ($users as $user){
//                try {
//                    $telegram->sendPhoto([
//                        'chat_id' => 549249454,
//                        'photo' => InputFile::create($image_path),
//                        'caption' => $caption,
//                        'parse_mode' => 'html'
//                    ]);
//                }catch (TelegramResponseException $exception){
//                    Log::error('telegram xatosi:'.$exception->getMessage());
//                }
//
//            }
        }catch (TelegramResponseException $exception)
        {
            Log::error('Yuborishdagi xatolik:'.$exception->getMessage());
        }
    }
}
