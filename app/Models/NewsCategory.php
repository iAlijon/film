<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
