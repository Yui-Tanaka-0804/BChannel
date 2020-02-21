<?php

namespace Tests\Unit;

use Tests\TestCase;

class ResponseTest extends TestCase
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
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // データを１件登録して、そのコピーをとる
        $insert_data = factory(\App\Response::class)->create();

        // データが正しく登録されているか
        $this->assertDatabaseHas('responses', [
            'content' => $insert_data->content,
        ]);
    }
}
