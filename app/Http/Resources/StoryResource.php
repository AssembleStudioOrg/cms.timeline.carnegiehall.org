<?php

namespace App\Http\Resources;

use A17\Twill\Services\MediaLibrary\ImageService;
use App\Models\Instrument;
use App\Models\MusicalFeature;
use App\Models\MusicVideo;
use App\Models\Theme;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;

class StoryResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $lite = str_contains($request->route()->uri, 'v2') && !str_contains($request->route()->uri, '{story}');
    $blocks = [];

    if (!$lite) {
      $blocks = $this->blocks()->whereNull('parent_id')->with(['children.files'])->get();

      foreach ($blocks as $block) {
        if ($block->type == 'text') {
          if (isset($block->content['text'])) {
            $content = $block->content;
            $content['text'] = Blade::compileString($block->content['text']);
            $block->content = $content;
          }
        }

        if ($block->type == 'map') {
          $block['center'] = [
            'lat' => isset($block->content['map_center_lat']) ? $block->content['map_center_lat'] : null,
            'lng' => isset($block->content['map_center_lng']) ? $block->content['map_center_lng'] : null,
          ];

          $block->items = $block->children->map(function ($child) {
            return [
              'position' => $child->position,
              'type' => $child->type,
              'name' => $child->content['name'] ?? null,
              'url' => $child->content['url'] ?? null,
              'lat' => $child->content['lat'] ?? null,
              'lng' => $child->content['lng'] ?? null,
            ];
          });

          unset($block->medias);
          unset($block->children);
          unset($block->content);
          unset($block->block);
          unset($block->editor_name);
          unset($block->id);
          unset($block->blockable_id);
          unset($block->blockable_type);
          unset($block->child_key);
          unset($block->parent_id);
          continue;
        }

        if ($block->type == 'accordion') {
          if (isset($block->children)) {
            foreach ($block->children as $child) {
              $child->title = $child->content['title'] ?? '';
              $child->content = $child->content['content'] ?? '';
              unset($child->medias);
              unset($child->files);
            }
          }
          unset($block->medias);
          unset($block->block);
        }

        if ($block->type == 'related-genres') {
          if (isset($block->content['browsers']['musicalFeatures']) || isset($block->content['browsers']['instruments']) || isset($block->content['browsers']['themes'])) {
            $selected_musical_feature_ids = $block->content['browsers']['musicalFeatures'];
            $selected_instrument_ids = $block->content['browsers']['instruments'];
            $selected_themes_ids = $block->content['browsers']['themes'];

            $musicalFeatures = MusicalFeature::find($selected_musical_feature_ids);
            $instruments = Instrument::find($selected_instrument_ids);
            $themes = Theme::find($selected_themes_ids);

            $block['musical-features'] = MusicalFeatureResource::collection($musicalFeatures);
            $block['instruments'] = InstrumentResource::collection($instruments);
            $block['themes'] = ThemeResource::collection($themes);
            unset($block->content);
            unset($block->editor_name);
            unset($block->medias);
            unset($block->children);
          }
        }

        foreach ($block->children as $child) {
          if (isset($child->medias)) {
            foreach ($child->medias as $media) {
              $child->media_full_url = ImageService::getRawUrl($media->uuid);

              unset($media->id);
              unset($media->created_at);
              unset($media->updated_at);
              unset($media->deleted_at);
              unset($media->uuid);
              unset($media->filename);
              unset($media->identifier);
              unset($media->pivot->mediable_id);
              unset($media->pivot->mediable_type);
              unset($media->pivot->media_id);
              unset($media->pivot->role);
              unset($media->pivot->metadatas);
              unset($media->pivot->created_at);
              unset($media->pivot->updated_at);
            }
          }

          if ($child->type == 'media-collection-item') {
            if (isset($child->content['browsers']['musicVideos'])) {
              $child->music_videos = MusicVideoResource::collection(MusicVideo::find($child->content['browsers']['musicVideos']));
            }
          }

          unset($child->id);
          unset($child->editor_name);
          unset($child->blockable_id);
          unset($child->blockable_type);
          unset($child->position);
          unset($child->child_key);
          unset($child->parent_id);
        }

        unset($block->editor_name);
        unset($block->id);
        unset($block->blockable_id);
        unset($block->blockable_type);
        unset($block->child_key);
        unset($block->parent_id);
      }
    }

    return [
      'id' => $this->id,
      'title' => $this->title,
      'slug' => $this->slug,
      'position' => $this->position,
      'hero_image' => $this->imageAsArray('hero_image'),
      'hero_image_attribution' => $this->hero_image_attribution,
      'color' => $this->color,
      'authors' => AuthorResource::collection($this->authors),
      'year_start' => $this->year_start,
      'year_finish' => $this->year_finish,
      'citation' => $this->citation,
      $this->mergeWhen(!$lite, [
        'default_song' => SongResource::make($this->song),
        'content' => $blocks,
      ]),
      'seo' => [
        'title' => $this->seo_title,
        'description' => $this->seo_description,
        'keywords' => $this->seo_keywords ?? null,
        'image' => $this->image('seo_image')
      ]
    ];
  }
}
