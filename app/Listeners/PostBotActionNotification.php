<?php

namespace App\Listeners;

use App\Events\PostBotAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostBotActionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostBotAction  $event
     * @return void
     */
    public function handle(PostBotAction $event)
    {
        $thread_id = $event->thread_id;
        $command = $event->command;

        // 以下はbotの処理
        if (\App\BotSpeak::where('command', $command)->exists()) {
            $data = \App\BotSpeak::where('command', $command)->latest()->first();

            if (\App\BotSpeak::where('command', $command)->latest()->first()->is_available_all()) {
                $res = new \App\Response;
                $res->thread_id = $thread_id;
                $res->content = $data->content;
                $res->save();
            } else {
                $threads = \App\BotSpeak::where('command', $command)->latest()->first()->threads();
                
                foreach ($threads as $thread) {
                    if ($thread->id == $thread_id) {
                        $res = new \App\Response;
                        $res->thread_id = $thread_id;
                        $res->content = $data->content;
                        $res->save();
                    }
                }
            }

        }
    }
}