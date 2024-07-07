<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_displayed(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSeeVolt('posts');
    }
}
