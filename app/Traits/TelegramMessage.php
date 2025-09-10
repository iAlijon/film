<?php


namespace App\Traits;


use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

trait TelegramMessage
{
    public function sendPhoto($chat_id,$photo,$message, $keyboard)
    {
       $response = Telegram::sendPhoto([
            'chat_id' => $chat_id,
            'photo' => InputFile::create($photo),
            'caption' => $message,
            'reply_markup' => $keyboard,
            'parse_mode' => 'HTML'
        ]);
       return $response;
    }

    public function sendMessage($chat_id, $message, $keyboard)
    {
        $response = Telegram::sendMessage([
           'chat_id' => $chat_id,
           'text' => $message,
           'reply_markup' => $keyboard,
           'parse_mode' => 'HTML'
        ]);

        return $response;
    }

    public function editMessageCaption($chat_id,$message_id,$caption)
    {
        Telegram::editMessageCaption([
           'chat_id' => $chat_id,
           'message_id' => $message_id,
           'caption' => $caption,
        ]);
    }
}
