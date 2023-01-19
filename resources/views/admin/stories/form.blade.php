@extends('twill::layouts.form', [
    'additionalFieldsets' => [['fieldset' => 'seo', 'label' => 'SEO']],
])

@section('contentFields')
    @formField('medias', [
    'name' => 'hero_image',
    'label' => 'Hero Image',
    'note' => 'Minimum image width 1400px',
    'required' => true
    ])


    @formField('input', [
    'name' => 'hero_image_attribution',
    'type' => 'text',
    'label' => 'Hero Image Attribution',
    'maxlength' => 255,
    'required' => false
    ])

    @formField('color', [
    'name' => 'color',
    'label' => 'Hero color'
    ])

    @formField('browser', [
    'label' => 'Authors',
    'name' => 'authors',
    'moduleName' => 'authors',
    'max' => 10
    ])

    @formField('input', [
    'name' => 'year_start',
    'label' => 'Year Start',
    'maxlength' => 4
    ])

    @formField('input', [
    'name' => 'year_finish',
    'label' => 'Year Finish',
    'maxlength' => 4
    ])

    @formField('browser', [
    'label' => 'Default Song',
    'name' => 'song',
    'moduleName' => 'songs'
    ])

    @formField('input', [
    'name' => 'citation',
    'label' => 'Citation',
    'maxlength' => 200,
    'required' => false,
    'type' => 'textarea',
    'rows' => 2
    ])

    @formField('block_editor', [
    'blocks' => ['title', 'text', 'media-collection', 'block-quote', 'info-text', 'author-reference', 'related-genres',
    'accordion', 'map']
    ])
@stop

@section('sideFieldsets')
    @include('admin/_includes/seo')
    @include('admin/_includes/api-link', ['name' => 'stories', 'entity' => $item->slug])
@endsection
