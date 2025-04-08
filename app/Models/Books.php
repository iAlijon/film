<?php

namespace App\Models;

use App\Traits\GlobalSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    use GlobalSearch;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(PersonCategory::class);
    }
}
