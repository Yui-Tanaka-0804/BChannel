<?php

use Illuminate\Database\Seeder;

class BotSpeakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BotSpeak::class)->create()->each(function ($b) {
            $ava = new \App\CommandAvailable;
            $ava->command_id = $b->id;
            $ava->thread_id = 0;
            $ava->save();
            Log::info('store BotSpeak from BotSpeakSeeder.', ["bot_speak_id" => $b->id, "command_available_id" => $ava->id, "ip" => "localhost"]);
        });
    }
}
