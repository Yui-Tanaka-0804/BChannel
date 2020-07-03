<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 各テスト実行前に呼ばれる。
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        // データベースマイグレーション
        $this->artisan('migrate');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        factory(\App\Thread::class)->create()->each(function(\App\Thread $thread) {
            $thread_id = $thread->id;
            $thread->responses()->saveMany(factory(\App\Response::class, 10)->make());
        });

        $thread_id = \App\Thread::inRandomOrder()->first()->id;

        $response = $this->get('/' . $thread_id);
        $response->assertStatus(200);
        $response->assertSeeText('1番から');
        $response->assertSeeInOrder(['<html', '<head', '<div class=\'page_order\'', '<div class=\'response_list\'']);

        $response = $this->get('/' . $thread_id . '?start_num=5&end_num=10');
        $response->assertStatus(200);
        $response->assertSeeText('5番から10番を表示');
        $response->assertSeeInOrder(['<html', '<head', '<div class=\'page_order\'', '<div class=\'response_list\'']);

        $response = $this->post('/' . $thread_id,['content' => 'post testing...',]);
        $response->assertRedirect('/' . $thread_id);
        $response = $this->get('/' . $thread_id);
        $response->assertSeeText('post testing...');

        $response = $this->post('/' . $thread_id . '?start_num=5&end_num=10',['content' => '5-10 post testing...',]);
        $response->assertRedirect('/' . $thread_id);
        $response = $this->get('/' . $thread_id);
        $response->assertSeeText('5-10 post testing...');        
    }
}
