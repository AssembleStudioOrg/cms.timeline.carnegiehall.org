<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MusicVideoResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'apple_music_video_attributes' => [
        'name' => $this->apple_music_video_song_name,
        'artist_name' => $this->apple_music_video_artist_name,
        'album_name' => $this->apple_music_video_album_name,
        'release_date' => $this->apple_music_video_release_date,
        'artwork' => $this->apple_music_artwork,
        'preview_video_url' => $this->apple_music_preview_video_url,
      ],
    ];
  }
}
