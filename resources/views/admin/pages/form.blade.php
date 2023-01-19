@extends('twill::layouts.form')

@section('contentFields')
    @formField('block_editor', [
        'withoutSeparator' => true,
        'blocks' => ['title', 'text', 'media-collection', 'block-quote', 'bibliography-collection', 'info-text', 'author-reference', 'related-genres', 'accordion', 'map', 'all-authors', 'media'],
    ])
@stop

@section('sideFieldsets')
    @include('admin/_includes/seo')
    @include('admin/_includes/api-link', ['name' => 'pages', 'entity' => $item->slug])
@endsection
