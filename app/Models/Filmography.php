<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filmography extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function filmography()
    {
        return $this->belongsTo(FilmographyGroup::class, 'filmography_group_id');
    }
}
