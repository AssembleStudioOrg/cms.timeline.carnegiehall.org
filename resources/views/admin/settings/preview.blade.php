@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
    'label' => 'Preview Base URL',
    'name' => 'preview_base_url',
    'textLimit' => '200',
    'placeholder' => 'e.g. https://project-name.vercel.app'
    ])
@stop
