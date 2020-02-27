<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Thread;

class ThreadTest extends TestCase
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
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // データを１件登録して、そのコピーをとる
        $insert_data = factory(Thread::class)->create();

        // データが正しく登録されているか
        $this->assertDatabaseHas('threads', [
            'name' => $insert_data->name,
        ]);
    }
}
