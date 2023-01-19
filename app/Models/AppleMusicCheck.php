<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\NonArchived;
use Spatie\Url\Url as Url;

class AppleMusicCheck extends Model
{
  use HasFactory;

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'is_archived' => 'boolean',
  ];

  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope(new NonArchived);
  }

  protected $fillable = [
    'song_id',
    'music_video_id',
    'is_song_valid',
    'is_music_video_valid',
    'is_archived'
  ];

  public function scopeIsArchived($query)
  {
    return $query->where('is_archived', 1);
  }

  public function getEditUrlAttribute()
  {
    if ($this->song_id) {
      $path = ['more', 'songs', $this->song_id, 'edit'];
      $url = Url::fromString((string) config('twill.admin_app_url'));
      return $url->withPath(join('/', $path));
    }

    if ($this->music_video_id) {
      $path = ['more', 'musicVideos', $this->music_video_id, 'edit'];
      $url = Url::fromString((string) config('twill.admin_app_url'));
      return $url->withPath(join('/', $path));
    }

    return config('twill.admin_app_url');
  }

  public function song()
  {
    return $this->belongsTo(Song::class);
  }

  public function musicVideo()
  {
    return $this->belongsTo(MusicVideo::class);
  }
}
