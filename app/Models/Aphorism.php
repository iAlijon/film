<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aphorism extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function calendar()
    {
        return $this->hasOne(Calendar::class, 'aphorism_id', 'id');
    }
}
