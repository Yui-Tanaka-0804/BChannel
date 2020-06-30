<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use SoftDeletes;
    
    public function thread()
    {
        return $this->belongsTo(App\Thread::class);
    }
}
