@extends('twill::layouts.settings')

@section('contentFields')
    @formField('input', [
    'label' => 'Webhook URL',
    'name' => 'vercel_webhook_url',
    'textLimit' => '200',
    'placeholder' => 'e.g. https://api.vercel.com/v1/integrations/deploy/proj_xxxx'
    ])
@stop
