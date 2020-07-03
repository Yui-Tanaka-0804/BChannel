<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Thread;

class TopPageTest extends TestCase
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
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('スレッド一覧');
        
        $response = $this->post('/',['name' => 'postTesting',]);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('threads', ['name' => 'postTesting',]);

        $thread_id = Thread::where("name", "postTesting")->first()->id;

        $response = $this->delete('/'.$thread_id);
        $this->assertSoftDeleted('threads', ['name' => 'postTesting',]);
    }
}
