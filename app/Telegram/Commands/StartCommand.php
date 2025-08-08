<?php
namespace App\Telegram\Commands;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class StartCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Boshlang‘ich buyruq';

    public function handle()
    {
        $keyboard = Keyboard::make()
            ->setResizeKeyboard(true)
            ->row(['Yangiliklar', 'Premyera'])
            ->row(['Kino tahlil', 'Suhbatlar'])
            ->row(['Shaxsiyat', 'Kinolug\'at'])
            ->row(['Kinofakt', 'Filmografoya'])
            ->row(['Kitoblar']);
        $this->replyWithMessage([
            'text' => "👋 Salom! Botimizga xush kelibsiz!",
            'reply_markup' => $keyboard
        ]);
    }
}
