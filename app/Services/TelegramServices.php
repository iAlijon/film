<?php
namespace App\Services;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Log;

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

            👉 @kinoArtUzBot
            TEXT;

            $url = "https://api.telegram.org/bot$token/sendPhoto";
            $users = TelegramUser::pluck('telegram_id')->filter();
            foreach ($users as $chat_id) {
                try {
                    $postFields = [
                        'chat_id' => (int)$chat_id,
                        'photo' => curl_file_create($image_path, 'news/jpeg', 'test.jpeg'),
                        'caption' => $caption,
                        'parse_mode' => 'HTML'
                    ];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                    $result = curl_exec($ch);
                    curl_close($ch);
                }catch (\Exception $e){
                    Log::info('chat_id', [$e->getMessage()]);
                }
            }
        }catch (\Exception $exception)

        {
            Log::error('Yuborishdagi xatolik:'.$exception->getMessage());
        }
    }
}
