@php
    use A17\Twill\Repositories\SettingRepository;
    $songChecks = $appleMusicChecks->whereNotNull('song_id');
    $musicVideoChecks = $appleMusicChecks->whereNotNull('music_video_id');

    $notifyEmailAddresses = [];
    if (app(SettingRepository::class)->byKey('apple_music_checker_notify_email_address_list')) {
        $notifyEmailAddresses = array_filter(explode(',', app(SettingRepository::class)->byKey('apple_music_checker_notify_email_address_list')), function ($s) {
            return filter_var($s, FILTER_VALIDATE_EMAIL);
        });
    }
@endphp

@extends('twill::layouts.free')

@section('customPageContent')
    <div class="run-check-resource-urls">
        <span>
            @if ($isJobRunning)
                Checking in progress...
            @endif
        </span>
        <span>
            @if (!count($notifyEmailAddresses))
                <p class="error">No email addresses configured for notifications. <a
                        href="/settings/apple-music-notifier">Configure now</a></p>
            @else
                <b>Email addresses to be notified: </b>
                @foreach ($notifyEmailAddresses as $notifyEmailAddress)
                    <span class="email">{{ $notifyEmailAddress }}</span>
                @endforeach

                <a href="/settings/apple-music-notifier">Edit</a>
            @endif
        </span>
        <a href="/run-check-resource-urls" title="Run the Apple Music resource check again">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                width="20" height="20" @if ($isJobRunning) class="spin" @endif>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
        </a>
    </div>
    <a17-fieldset title="List of Invalid Songs">
        <div class="custom-table">
            <table class="table" id="songs-table">
                <tbody>
                    @if (!count($songChecks))
                        <tr>
                            <td colspan="4" class="nothing">Nice! Nothing to worry about here.</td>
                        </tr>
                    @endif
                    @foreach ($songChecks as $songCheck)
                        <tr>
                            <td width="60"><img src="{{ $songCheck->song->cmsImage() }}"
                                    alt="{{ $songCheck->song->title }}" width="60" height="60" />
                            </td>
                            <td>
                                <p>{{ $songCheck->song->title }} <span>(#{{ $songCheck->song->id }})</span></p>
                                <div class="song-check-details">
                                    <p>{{ $songCheck->song->apple_music_artist_name }}</p>
                                    <p>{{ $songCheck->song->apple_music_song_name }}</p>
                                </div>
                            </td>
                            <td align="right" class="checked">
                                <p>Last checked:<br />{{ $songCheck->created_at }}</p>
                            </td>
                            <td align="right"><a href="{{ route('admin.songs.edit', $songCheck->song) }}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </a17-fieldset>

    <a17-fieldset title="List of Invalid Music Videos">
        <div class="custom-table">
            <table class="table" id="music-videos-table">
                <tbody>
                    @if (!count($musicVideoChecks))
                        <tr>
                            <td colspan="4" class="nothing">Nice! Nothing to worry about here.</td>
                        </tr>
                    @endif
                    @foreach ($musicVideoChecks as $musicVideoCheck)
                        <tr>
                            <td width="60"><img src="{{ $musicVideoCheck->musicVideo->cmsImage() }}"
                                    alt="{{ $musicVideoCheck->musicVideo->title }}" width="60" height="60" />
                            </td>
                            <td>
                                <p>{{ $musicVideoCheck->musicVideo->title }}
                                    <span>(#{{ $musicVideoCheck->musicVideo->id }})</span>
                                </p>

                                <div class="song-check-details">
                                    <p>{{ $musicVideoCheck->musicVideo->apple_music_video_artist_name }}</p>
                                    <p>{{ $musicVideoCheck->musicVideo->apple_music_video_song_name }}</p>
                                </div>
                            </td>
                            <td align="right" class="checked">
                                <p>Last checked:<br />{{ $songCheck->created_at }}</p>
                            </td>
                            <td align="right"><a
                                    href="{{ route('admin.musicVideos.edit', $musicVideoCheck->musicVideo) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </a17-fieldset>
@stop

@push('extra_css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
@endpush
