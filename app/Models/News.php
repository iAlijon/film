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


    public function getContentAttribute($value)
    {
        $appUrl = config('app.url').'/';
         $img = preg_replace_callback('/(<img\s+[^>]*src=")\/?(uploads\/[^"]+)(")/i', function ($matches) use ($appUrl) {
             // $matches[1] – rasmning nisbiy yoʻli: "uploads/images/example.jpg"
             return '<img src="' . $appUrl . $matches[2] . '"';
         }, $value);
         return $img;
    }

}
