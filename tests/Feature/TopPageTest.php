<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Thread;

class TopPageTest extends TestCase
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
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('スレッド一覧');
        $response->assertSeeInOrder(['<form', 'name="_token"', '</form>']);
        
        $response = $this->post('/',['name' => '/ post testing...',]);
        $response->assertRedirect('/');
        
        $insert_data = Thread::where('name', '/ post testing...')->first();

        $response = $this->get('/' . $insert_data->id);
        $response->assertOk();
        // $response->assertSeeInOrder(['<form', 'name="_token"', '<p', '<a href="', '</a>', '"submit" value="削除"', '</p>', '</form>']);

        $response = $this->delete('/' . $insert_data->id);
        $response->assertRedirect('/');
        $response = $this->get('/' . $insert_data->id);
        $response->assertNotFound();
    }
}
