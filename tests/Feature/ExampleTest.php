<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test dasar API Event.
     */
    public function test_api_event_endpoint(): void
    {
        $response = $this->get('/api/event');

        $response->assertStatus(200);
    }
}