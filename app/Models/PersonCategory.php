<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function person()
    {
        return $this->hasMany(Person::class, 'person_category_id', 'id');
    }
}
