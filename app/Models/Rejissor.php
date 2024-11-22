<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejissor extends Model
{
    use HasFactory;
    protected $table = 'rejissor';
    protected $fillable = [
        'full_name_oz',
        'full_name_uz',
        'full_name_ru',
        'full_name_en',
        'description_oz',
        'description_uz',
        'description_ru',
        'description_en',
    ];
}
