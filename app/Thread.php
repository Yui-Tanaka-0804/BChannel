<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function responses_count()
    {
        return $this->hasMany(Response::class)->count();
    }
}
