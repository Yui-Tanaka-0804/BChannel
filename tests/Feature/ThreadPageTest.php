<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $insert_data = factory(\App\Response::class, 10)->create();

        $response = $this->get('/aaa');
        $response->assertStatus(200);
        $response->assertSeeText('1番から');
        $response->assertSeeInOrder(['<html', '<head', '<div class=\'page_order\'', '<div class=\'response_list\'']);

        $response = $this->get('/aaa/5-10');
        $response->assertStatus(200);
        $response->assertSeeText('5番から10番を表示');
        $response->assertSeeInOrder(['<html', '<head', '<div class=\'page_order\'', '<div class=\'response_list\'']);

        $response = $this->post('/aaa',['content' => '/aaa post testing...',]);
        $response->assertRedirect('/aaa');
        $response = $this->get('/aaa');
        $response->assertSeeText('/aaa post testing...');

        $response = $this->post('/aaa/5-10',['content' => '/aaa/5-10 post testing...',]);
        $response->assertRedirect('/aaa');
        $response = $this->get('/aaa');
        $response->assertSeeText('/aaa/5-10 post testing...');        
    }
}
