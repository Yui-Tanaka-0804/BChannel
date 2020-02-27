<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function thread()
    {
        return $this->belongsTo(App\Thread::class);
    }
}
