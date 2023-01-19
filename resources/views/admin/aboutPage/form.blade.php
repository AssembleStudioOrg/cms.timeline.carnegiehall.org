@extends('twill::layouts.form')

@section('contentFields')
@formField('block_editor', [
'withoutSeparator' => true,
'blocks' => ['image-and-text', 'block-quote']
])
@stop
