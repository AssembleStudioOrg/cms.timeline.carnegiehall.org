@php
    $artworkImageSrcUrl = isset($item->apple_music_artwork->url) ? str_replace('{w}', '600', str_replace('{h}', '600', $item->apple_music_artwork->url)) : null;
@endphp

@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
    'name' => 'apple_music_video_id',
    'label' => 'Apple Music Video ID',
    'maxlength' => 30,
    'required' => false
    ])
@stop

@section('sideFieldsets')
    @formFieldset(['id' => 'apple-music-search', 'title' => 'Search on Apple Music', 'open' => true])
    <br />
    <a17-apple-music-search></a17-apple-music-search>
    @endformFieldset

    @if ($item->apple_music_video_payload)
        @formFieldset(['id' => 'stored-apple-music-video', 'title' => 'Apple Music Video Details', 'open' => true])
        <div class="payload-data-items">
            <img src="{{ $artworkImageSrcUrl }}" width="100%" />
            <p><b>Artist: </b>{{ $item->apple_music_video_artist_name }}</p>
            <p><b>Album: </b>{{ $item->apple_music_video_album_name }}</p>
            <p><b>Song: </b>{{ $item->apple_music_video_name }}</p>
            <p><b>Release date: </b>{{ $item->apple_music_video_release_date }}</p>
            <p><b>Preview video URL: </b><a href="{{ $item->apple_music_preview_video_url }}"
                    title="Open preview video in new tab" target='_blank'>Link</a></p>
        </div>
    @endformFieldset

    @formFieldset(['id' => 'apple-music-video', 'title' => 'Apple Music Video Data', 'open' => false])
    <textarea class="payload-display" name='apple_music_video_payload_as_string' readonly>{{ $item->apple_music_video_payload_as_string }}</textarea>
    <p class="updated-at">Updated at: {{ $item->apple_music_video_data_updated_at }}
    </p>
    @endformFieldset
    @endif

    @include('admin/_includes/api-link', ['name' => 'music-videos', 'entity' => $item->id])
@endsection

@push('extra_js')
    <script>
        // Set the developer token to be used in the custom js file.
        window.apple_music_developer_token = '{{ config('apple-music.developer_token') }}';

        // Inject the widget
        var element = document.createElement('div');
        element.id = 'video-finder-widget';
        element.innerHTML = '<video-finder/>'; // add the vue component
        var fieldElement = document.getElementsByName('apple_music_video_id')[0].parentNode;
        if (fieldElement) fieldElement.parentNode.insertBefore(element, fieldElement.nextSibling);
    </script>

    {{-- For this project, no custom JS has been created. We're going to inject the global app js here for now. --}}
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

<style>
    .payload-display {
        margin: 20px 0;
        padding: 8px;
        font-size: 12px;
        color: #444;
        border-radius: 6px;
        border: 2px solid #ccc;
        width: 100%;
        height: 300px;
    }

    .updated-at {
        margin: 0 !important;
        font-size: 12px;
        color: #666;
    }

    .payload-data-items {
        padding-top: 20px;
    }

    .payload-data-items img {
        margin-bottom: 12px;
    }

    .payload-data-items p {
        font-size: 12px !important;
        color: #444 !important;
        margin-bottom: 6px;
    }
</style>
