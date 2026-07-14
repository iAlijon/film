<?php

namespace App\Models;

use App\Traits\GlobalSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    use GlobalSearch;

    protected $fillable = [
        'video',
        'width_ratio',
        'height_ratio',
        'status',
    ];
}
