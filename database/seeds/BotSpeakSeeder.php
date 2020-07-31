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
        factory(App\BotSpeak::class)->create();
    }
}
