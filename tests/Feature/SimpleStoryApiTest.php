<?php

namespace Tests\Feature;

use App\Models\Story;
use Tests\TestCase;

class SimpleStoryApiTest extends TestCase
{
  public function testApi()
  {
    $entry = Story::published()->first();
    $response = $this->get('/api/story/' . $entry->id);
    $response->assertStatus(200);
  }
}
