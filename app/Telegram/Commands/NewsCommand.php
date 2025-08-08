<?php
namespace App\Telegram\Commands;

use App\Models\News;
use Telegram\Bot\Commands\Command;

class NewsCommand extends Command
{
    protected string $name = 'Yangiliklar';
    protected $model;
    public function __construct()
    {
        $this->model = new News();
    }

    public function handle()
    {
        $models = $this->model->where('status', 1)->orderBy('created_at', 'desc');
    }
}

