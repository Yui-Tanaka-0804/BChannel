<?php

use Illuminate\Database\Seeder;
use App\Thread;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Thread::class, 10)->create()->each(function(App\Thread $thread) {
            Log::info('store Thread from ThreadSeeder.', ["thread_id" => $thread->id, "ip" => "localhost"]);
        });
    }
}
