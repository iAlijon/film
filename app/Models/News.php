<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(PersonCategory::class);
    }

    public function getContentAttribute($data)
    {
        $appUrl = config('app.url') . '/public/';
        return preg_replace('/<img src="(uploads\/[^"]+)"/i', '<img src="' . $appUrl . 'uploads/images/news"', $data);
    }
}
