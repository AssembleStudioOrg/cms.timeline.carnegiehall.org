@extends('twill::layouts.settings', [
    'customTitle' => 'Apple Music Notifier',
])

@section('contentFields')
    @formField('input', [
        'label' => 'Email Addresses to be notified if Apple Music song or video is broken',
        'name' => 'apple_music_checker_notify_email_address_list',
        'textLimit' => '200',
        'placeholder' => 'e.g. simon@example.com',
        'note' => 'This can be comma deliminated. No spaces.',
    ])
@stop
