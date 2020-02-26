<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Thread;

class TopPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $insert_data = factory(Thread::class, 10)->create();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSeeText('スレッド一覧');
        $response->assertSeeInOrder(['<form', 'name="_token"', '<p', '<a href="', '</a>', '"submit" value="削除"', '</p>', '</form>']);

        $response = $this->post('/',['name' => '/ post testing...',]);
        $response->assertRedirect('/');
        $response = $this->get('/' . Thread::where('name', '/ post testing...')->first()->id);
        $response->assertOk();

        $response = $this->delete('/' . $insert_data[0]->id);
        $response->assertRedirect('/');
        $response = $this->get('/' . $insert_data[0]->id);
        $response->assertNotFound();
    }
}
