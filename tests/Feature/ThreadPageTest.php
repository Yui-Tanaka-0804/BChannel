<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadPageTest extends TestCase
{
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
        $insert_data = factory(\App\Thread::class)->create();

        $thread = \App\Thread::All()->first();
        $thread_id = $thread->id;

        $response = $this->get('/' . $thread_id);
        $response->assertStatus(200);
        $response->assertSeeText('1番から');
        $response->assertSeeInOrder(['<html', '<head', '<div class=\'page_order\'', '<div class=\'response_list\'']);

        $response = $this->get('/' . $thread_id . '/5-10');
        $response->assertStatus(200);
        $response->assertSeeText('5番から10番を表示');
        $response->assertSeeInOrder(['<html', '<head', '<div class=\'page_order\'', '<div class=\'response_list\'']);

        $response = $this->post('/' . $thread_id,['content' => 'post testing...',]);
        $response->assertRedirect('/' . $thread_id);
        $response = $this->get('/' . $thread_id);
        $response->assertSeeText('post testing...');

        $response = $this->post('/' . $thread_id . '/5-10',['content' => '5-10 post testing...',]);
        $response->assertRedirect('/' . $thread_id);
        $response = $this->get('/' . $thread_id);
        $response->assertSeeText('5-10 post testing...');        
    }
}
