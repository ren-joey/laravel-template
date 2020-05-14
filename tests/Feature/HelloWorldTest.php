<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloWorldTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/hello-world');

        // 如果連線 `hello-world/`，HTTP Status 應該要顯示 200（成功連線）
        $response->assertStatus(200);

        //連線到網頁內，應該要可以看到「Hello world!」這些字
        $response->assertSee('Hello world!');
    }
}
