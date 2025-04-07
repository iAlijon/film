<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'categories';

    public function person()
    {
        return $this->hasMany(Person::class, 'person_category_id', 'id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }

    public function premiere()
    {
        return $this->hasOne(Premiere::class, 'category_id', 'id');
    }

    public function interview()
    {
        return $this->hasOne(Interview::class, 'category_id', 'id');
    }

    public function interviewPeople()
    {
        return $this->hasOne(InterviewPeoples::class, 'category_id', 'id');
    }

    public function filmography()
    {
        return $this->hasOne(Filmography::class, 'category_id', 'id');
    }

    public function book()
    {
        return $this->hasOne(Books::class, 'category_id', 'id');
    }

    public function analysis()
    {
        return $this->hasMany(FilmAnalysis::class);
    }
}
