@php
    $selected_musical_feature_ids = $block->browserIds('musicalFeatures');
    $selected_instrument_ids = $block->browserIds('instruments');
    $selected_themes_ids = $block->browserIds('themes');

    $musicalFeatures = App\Models\MusicalFeature::find($selected_musical_feature_ids);
    $instruments = App\Models\Instrument::find($selected_instrument_ids);
    $themes = App\Models\Theme::find($selected_themes_ids);

    $musicalFeaturesList = $musicalFeatures->map(function ($musicalFeature) {
        return $musicalFeature->title;
    });

    $instrumentsList = $instruments->map(function ($instrument) {
        return $instrument->title;
    });

    $themesList = $themes->map(function ($theme) {
        return $theme->title;
    });

    $list = Illuminate\Support\Arr::collapse([$musicalFeaturesList->toArray(), $instrumentsList->toArray(), $themesList->toArray()]);
    $list = Illuminate\Support\Arr::sort($list);
@endphp

<div class="border p-10 border-black prose">
    <h3>Explore Related Genres</h3>
    <p class="text-sm">{{ implode(', ', $list) }}</p>
</div>
