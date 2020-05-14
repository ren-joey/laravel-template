<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutUsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/about-us');

        $response->assertStatus(200);
        $response->assertSee('嗨！大家好！');
        $response->assertSee('側邊欄');
        $response->assertSee('我們是未知');

        $name = 'S.H.E';
        $response = $this->get("/about-us/{$name}");
        $response->assertStatus(200);
        $response->assertSee('嗨！大家好！');
        $response->assertSee('側邊欄');
        $response->assertSee("我們是{$name}");
    }
}
