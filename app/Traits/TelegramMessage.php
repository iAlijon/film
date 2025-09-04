<?php


namespace App\Traits;


use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

trait TelegramMessage
{
    public function sendPhoto($chat_id,$photo,$message, $keyboard)
    {
        Telegram::sendPhoto([
            'chat_id' => $chat_id,
            'photo' => InputFile::create($photo),
            'caption' => $message,
            'reply_markup' => $keyboard,
            'parse_mode' => 'HTML'
        ]);
    }

    public function sendMessage($chat_id, $message, $keyboard)
    {
        Telegram::sendMessage([
           'chat_id' => $chat_id,
           'text' => $message,
           'reply_markup' => $keyboard,
           'parse_mode' => 'HTML'
        ]);
    }
}
