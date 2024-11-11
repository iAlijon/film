<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name_oz',
        'full_name_uz',
        'full_name_ru',
        'full_name_en',
        'images',
        'birth-date',
        'status',
        'description_oz',
        'description_uz',
        'description_ru',
        'description_en',
        'content_oz',
        'content_uz',
        'content_ru',
        'content_en',
    ];
}
