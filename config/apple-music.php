<?php

use Illuminate\Support\Facades\Log;
use PouleR\AppleMusicAPI\AppleMusicAPITokenGenerator;

try {
  $tokenGenerator = new AppleMusicAPITokenGenerator();
  $jwtToken = $tokenGenerator->generateDeveloperToken(
    env('APPLE_MUSIC_TEAM_ID', ''),
    env('APPLE_MUSIC_KEY_ID', ''),
    dirname(__FILE__, 2) . '/apple-music.p8'
  );
} catch (\Throwable $th) {
  $jwtToken = '';
  report($th);
  Log::warning('Apple Music developer token could not be generated.');
}

return [
  'developer_token' => $jwtToken
];
