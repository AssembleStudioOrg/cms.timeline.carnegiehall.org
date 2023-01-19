<?php

namespace Tests\Feature;

use App\Models\MusicalFeature;
use Tests\TestCase;

class SimpleMusicalFeatureApiTest extends TestCase
{
  public function testApi()
  {
    $entry = MusicalFeature::published()->first();
    $response = $this->get('/api/musical-features/' . $entry->id);
    $response->assertStatus(200);
  }
}
