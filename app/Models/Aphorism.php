<?php

namespace App\Models;

use App\Traits\GlobalSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aphorism extends Model
{
    use HasFactory;
    use GlobalSearch;
    protected $guarded = [];

    public function calendar()
    {
        return $this->hasMany(Calendar::class, 'aphorism_id', 'id');
    }
}
