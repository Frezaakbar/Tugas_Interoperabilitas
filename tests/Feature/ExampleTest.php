<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // 1. Import trait ini
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase; // 2. Pakai trait ini di sini

    /**
     * Test dasar API Event.
     */
    public function test_api_event_endpoint(): void
    {
        $response = $this->get('/api/event');

        $response->assertStatus(200);
    }
}