<?php

use App\Response;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Thread::class)->create()->each(function(App\Thread $thread) {
            $thread->responses()->saveMany(factory(App\Response::class, rand(1, 10))->make());
            Log::info('store Thread from ResponseSeeder.', ["thread_id" => $thread->id, "response_id" => $thread->responses()->get(['id']), "ip" => "localhost"]);
        });

    }
}
