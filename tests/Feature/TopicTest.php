<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopicTest extends TestCase
{
    /**
    * Get all Topic.
    *
    * @return void
    */
    public function testGetAll()
    {
        $response = $this->get('/api/v1/topic');
        
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status', 'code', 'data'
            ]);
    }
}
