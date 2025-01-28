<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookgroup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function book()
    {
        return $this->hasOne(Books::class, 'book_category');
    }
}
