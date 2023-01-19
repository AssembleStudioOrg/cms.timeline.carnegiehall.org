@extends('twill::layouts.form', [
    'additionalFieldsets' => [['fieldset' => 'songs', 'label' => 'Songs'], ['fieldset' => 'influences', 'label' => 'Influences'], ['fieldset' => 'stories', 'label' => 'Stories'], ['fieldset' => 'notablePerformers', 'label' => 'Notable Performers'], ['fieldset' => 'seo', 'label' => 'SEO']],
])

@section('contentFields')
    @formField('input', [
    'name' => 'name',
    'label' => 'Name',
    'maxlength' => 255,
    'required' => true
    ])

    @formField('medias', [
    'name' => 'hero_image',
    'label' => 'Hero image',
    'required' => true
    ])

    @formField('wysiwyg', [
    'name' => 'hero_caption',
    'label' => 'Image Caption',
    'toolbarOptions' => ['bold', 'italic', 'link']
    ])

    @formField('input', [
    'name' => 'hero_credit',
    'label' => 'Image Credit',
    'type' => 'text'
    ])

    @formField('input', [
    'name' => 'hero_credit_link',
    'label' => 'Image Credit Link',
    'type' => 'text'
    ])

    @formField('browser', [
    'label' => 'Authors',
    'name' => 'authors',
    'moduleName' => 'authors',
    'search' => false,
    'max' => 10
    ])

    @formField('input', [
    'name' => 'year_start',
    'label' => 'Year Start',
    'type' => 'number'
    ])

    @formField('input', [
    'name' => 'year_finish',
    'label' => 'Year Finish',
    'type' => 'number'
    ])

    @formField('select', [
    'name' => 'tradition',
    'label' => 'Tradition',
    'placeholder' => 'Select an tradition',
    'options' => $traditions
    ])

    @formField('input', [
    'name' => 'display_date',
    'label' => 'Display Date',
    'maxlength' => 255
    ])

    @formField('browser', [
    'label' => 'Default Song',
    'name' => 'song',
    'moduleName' => 'songs'
    ])

    @formField('input', [
    'name' => 'citation',
    'label' => 'Citation',
    'required' => false,
    'type' => 'textarea',
    'rows' => 2
    ])

    @formField('block_editor', [
    'blocks' => ['title', 'text', 'media-collection', 'block-quote', 'bibliography-collection', 'related-genres',
    'accordion', 'map']
    ])

@stop

@section('fieldsets')
    <a17-fieldset title="Songs" id="songs">
        @formField('browser', [
        'moduleName' => 'songs',
        'name' => 'songs',
        'label' => 'Songs',
        'max' => 50
        ])
    </a17-fieldset>

    <a17-fieldset title="Influences" id="influences">
        @formField('browser', [
        'moduleName' => 'genres',
        'name' => 'influences',
        'label' => 'Influenced',
        'max' => 50
        ])

        @formField('browser', [
        'moduleName' => 'genres',
        'name' => 'influenced',
        'label' => 'Influenced by',
        'max' => 50
        ])

        @formField('browser', [
        'moduleName' => 'genres',
        'name' => 'cross_influences',
        'label' => 'Cross Influenced',
        'max' => 50
        ])

        @formField('browser', [
        'moduleName' => 'genres',
        'name' => 'cross_influenced',
        'label' => 'Cross Influenced by',
        'max' => 50
        ])
    </a17-fieldset>

    <a17-fieldset title="Stories" id="stories">
        @formField('browser', [
        'moduleName' => 'stories',
        'name' => 'stories',
        'label' => 'Stories',
        'max' => 50
        ])
    </a17-fieldset>

    <a17-fieldset title="Notable Performers" id="notablePerformers">
        @formField('browser', [
        'moduleName' => 'notablePerformers',
        'name' => 'notable_performers',
        'label' => 'Performers',
        'max' => 50
        ])
    </a17-fieldset>

    <a17-fieldset title="Instruments" id="instruments">
        @formField('browser', [
        'moduleName' => 'instruments',
        'name' => 'instruments',
        'label' => 'Instruments',
        'max' => 50
        ])
    </a17-fieldset>

    <a17-fieldset title="Themes" id="themes">
        @formField('browser', [
        'moduleName' => 'themes',
        'name' => 'themes',
        'label' => 'Themes',
        'max' => 50
        ])
    </a17-fieldset>

    <a17-fieldset title="Musical Features" id="musicalFeatures">
        @formField('browser', [
        'moduleName' => 'musicalFeatures',
        'name' => 'musical_features',
        'label' => 'Musical Features',
        'max' => 50
        ])
    </a17-fieldset>
@stop

@section('sideFieldsets')
    @include('admin/_includes/seo')
    @include('admin/_includes/api-link', ['name' => 'genres', 'entity' => $item->slug])
@endsection
