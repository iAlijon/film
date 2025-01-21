<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleAssociatedWithTheFilmCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(PeopleFilmCategory::class);
    }

    public function interview_category()
    {
        return $this->hasMany(InterviewPeoples::class, 'id', 'interview_category_id');
    }
}
