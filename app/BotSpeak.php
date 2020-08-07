<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BotSpeak extends Model
{
    use SoftDeletes;

    public function threads()
    {
        return $this->belongsToMany('App\Thread', 'command_availables', 'command_id');
    }

    public function is_available_all()
    {
        return $this->hasMany('App\CommandAvailable', 'command_id')->first()->thread_id == 0;
    }
}
