<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Model;
use App\Models\NotablePerformer;

class Song extends Model
{
  use HasRelated;
  use HasFiles;

  protected $fillable = [
    'published',
    'title',
    'mp4_sound',
    'mp4_video',
    'apple_music_song_id',
    'notable_performer_id',
    'apple_music_payload',
    'apple_music_data_updated_at',
  ];

  public $checkboxes = [
    'published'
  ];

  protected $casts = [
    'apple_music_payload' => 'object',
  ];

  public $filesParams = ['song', 'video'];

  public $mediasParams = [
    'hero' => [
      'default' => []
    ],
  ];

  public function cmsImage()
  {
    return isset($this->apple_music_artwork->url) ? str_replace('{w}', '600', str_replace('{h}', '600', $this->apple_music_artwork->url)) : null;
  }

  public function getAppleMusicPayloadAsStringAttribute()
  {
    if ($this->apple_music_payload) {
      return json_encode($this->apple_music_payload, JSON_PRETTY_PRINT);
    }

    return null;
  }

  public function getAppleMusicSongNameAttribute()
  {
    if (isset($this->apple_music_payload->data[0]->attributes->name)) {
      return $this->apple_music_payload->data[0]->attributes->name;
    }

    return null;
  }

  public function getAppleMusicArtistNameAttribute()
  {
    if (isset($this->apple_music_payload->data[0]->attributes->artistName)) {
      return $this->apple_music_payload->data[0]->attributes->artistName;
    }

    return null;
  }

  public function getAppleMusicAlbumNameAttribute()
  {
    if (isset($this->apple_music_payload->data[0]->attributes->albumName)) {
      return $this->apple_music_payload->data[0]->attributes->albumName;
    }

    return null;
  }

  public function getAppleMusicReleaseDateAttribute()
  {
    if (isset($this->apple_music_payload->data[0]->attributes->releaseDate)) {
      return $this->apple_music_payload->data[0]->attributes->releaseDate;
    }

    return null;
  }

  public function getAppleMusicArtworkAttribute()
  {
    if (isset($this->apple_music_payload->data[0]->attributes->artwork)) {
      return $this->apple_music_payload->data[0]->attributes->artwork;
    }

    return null;
  }

  public function getAppleMusicPreviewSongUrlAttribute()
  {
    if (isset($this->apple_music_payload->data[0]->attributes->previews[0]->url)) {
      return $this->apple_music_payload->data[0]->attributes->previews[0]->url;
    }

    return null;
  }

  public function getArtistAttribute()
  {
    return optional($this->notable_performer)->name;
  }

  public function genres()
  {
    return $this->belongsToMany(Genre::class);
  }

  public function notable_performer()
  {
    return $this->belongsTo(NotablePerformer::class);
  }
}
