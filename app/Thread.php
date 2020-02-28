<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function responses_count()
    {
        return $this->hasMany(Response::class)->count();
    }
}
