<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentary extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_oz',
        'name_uz',
        'description_oz',
        'description_uz',
        'content_oz',
        'content_uz',
        'images',
        'status'
    ];
}
