<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    protected $guarded = [];

//    public function category()
//    {
//        return $this->hasOne(PeopleAssociatedWithTheFilmCategory::class, 'id', 'interview_category_id');
//    }

    public function category()
    {
        return $this->belongsTo(PersonCategory::class);
    }
    public function people()
    {
        return $this->hasOne(InterviewPeoples::class, 'id', 'interview_people_id');
    }
}
