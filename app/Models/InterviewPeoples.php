<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewPeoples extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function interview_category()
    {
        return $this->belongsTo(PeopleAssociatedWithTheFilmCategory::class);
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }
}
