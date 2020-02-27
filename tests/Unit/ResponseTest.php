<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponseTest extends TestCase
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
        $insert_data = factory(\App\Thread::class)->create()->each(function(\App\Thread $thread) {
            $thread->responses()->saveMany(factory(\App\Response::class, rand(1, 10))->make());
        });

        // データが正しく登録されているか
        $this->assertTrue($insert_data);
    }
}
