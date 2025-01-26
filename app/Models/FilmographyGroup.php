<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmographyGroup extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function filmography()
    {
        return $this->hasOne(Filmography::class);
    }
}
