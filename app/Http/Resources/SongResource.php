<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SongResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $isApiV2 = str_contains($request->route()->uri, 'v2');

    return [
      'id' => $this->id,
      'title' => $this->title,
      'apple_music_song_id' => $this->apple_music_song_id,
      $this->mergeWhen(!$isApiV2, [ // original endpoint fetches the song data from Apple Music at request time.
        'song_file' => $this->apple_music_song_id ? $this->apple_music_preview_url : $this->file('song'),
        'apple_music_attributes' => [
          'name' => $this->apple_music_song_name,
          'artist_name' => $this->apple_music_artist_name,
          'album_name' => $this->apple_music_album_name,
          'release_date' => $this->apple_music_release_date,
          'artwork' => $this->apple_music_artwork,
          'preview_song_url' => $this->apple_music_preview_song_url,
        ],
      ]),
      $this->mergeWhen($isApiV2, [ // v2 of the api uses this file if a song is manually uploaded.
        'song_file' => $this->file('song'),
        'apple_music_attributes' => [
          'name' => $this->apple_music_song_name,
          'artist_name' => $this->apple_music_artist_name,
          'album_name' => $this->apple_music_album_name,
          'release_date' => $this->apple_music_release_date,
          'artwork' => $this->apple_music_artwork,
          'preview_song_url' => $this->apple_music_preview_song_url,
        ],
      ]),
      'video_file' => $this->file('video'),
    ];
  }
}
