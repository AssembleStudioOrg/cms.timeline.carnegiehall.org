<?php

namespace Tests\Feature;

use App\Models\Story;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimpleStoryApiTest extends TestCase
{
  public function testApi()
  {
    $entry = Story::published()->first();
    $response = $this->get('/api/authors/' . $entry->id);
    $response->assertStatus(200);
  }
}
