<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorConversation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function actor()
    {
        return $this->hasOne(Actor::class, 'id', 'actor_id');
    }
}
