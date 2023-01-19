@extends('twill::layouts.form', [
    'disableContentFieldset' => true,
])

@section('fieldsets')
    @formFieldset(['id' => 'default_song', 'title' => 'Default Song'])
    @formField('browser', [
    'name' => 'song',
    'label' => 'Songs',
    'moduleName' => 'songs'
    ])
    @endformFieldset

    @formFieldset(['id' => 'featured_stories', 'title' => 'Featured Stories'])
    @formField('browser', [
    'name' => 'featured_stories',
    'label' => 'Stories',
    'moduleName' => 'stories',
    'max' => 5
    ])
    @endformFieldset

    @formFieldset(['id' => 'missing_notable_performers', 'title' => 'Missing Notable Performers'])
    @formField('wysiwyg', [
    'label' => 'Content',
    'name' => 'missing_content',
    'placeholder' => '',
    'required' => true,
    ])

    @formField('input', [
    'label' => 'URL',
    'name' => 'missing_link_href',
    'type' => 'url',
    'placeholder' => 'e.g. https://www.example.com',
    'required' => true,
    ])

    @formField('input', [
    'label' => 'Link Text',
    'name' => 'missing_link_label',
    'placeholder' => 'e.g Learn more',
    'required' => true,
    ])
    @endformFieldset

    @formFieldset(['id' => '404_page', 'title' => '404 Page'])
    @formField('input', [
    'label' => '404: Heading',
    'name' => '404_heading',
    'placeholder' => '',
    'required' => true,
    ])

    @formField('input', [
    'label' => '404: CTA',
    'name' => '404_cta_message',
    'placeholder' => 'e.g. Continue Exploring Other Stories',
    'required' => true,
    ])

    @formField('input', [
    'label' => '404: Relative Link',
    'name' => '404_cta_relative_link',
    'placeholder' => 'e.g. /stories',
    'required' => true,
    ])
    @endformFieldset
@stop

@section('sideFieldsets')
    @formFieldset(['id' => 'default_seo', 'title' => 'Default SEO'])
    @formField('input', [
    'label' => 'Site Name',
    'name' => 'site_name',
    'placeholder' => 'e.g. Timeline of African American Music',
    'required' => true,
    ])
    @formField('input', [
    'label' => 'Stories Index Heading',
    'name' => 'stories_index_heading',
    'placeholder' => '',
    'required' => true,
    ])
    @formField('medias', [
    'label' => 'Default Meta Image',
    'name' => 'seo_image',
    'required' => true,
    ])
    @formField('input', [
    'label' => 'Default Stories Meta Title',
    'name' => 'seo_stories_title',
    'required' => true,
    ])
    @formField('input', [
    'type' => 'textarea',
    'label' => 'Default Stories Meta Description',
    'name' => 'seo_stories_description',
    'required' => true,
    'rows' => '2'
    ])
    @formField('medias', [
    'label' => 'Default Stories Meta Image',
    'name' => 'seo_stories_image',
    'required' => true,
    ])
    @formField('input', [
    'label' => 'Default Genres Meta Title',
    'name' => 'seo_genres_title',
    'required' => true,
    ])
    @formField('input', [
    'type' => 'textarea',
    'label' => 'Default Genres Meta Description',
    'name' => 'seo_genres_description',
    'required' => true,
    'rows' => '2'
    ])
    @formField('medias', [
    'label' => 'Default Genres Meta Image',
    'name' => 'seo_genres_image',
    'required' => true,
    ])
    @formField('input', [
    'label' => 'Default Timeline Meta Title',
    'name' => 'seo_timeline_title',
    'required' => true,
    ])
    @formField('input', [
    'type' => 'textarea',
    'label' => 'Default Timeline Meta Description',
    'name' => 'seo_timeline_description',
    'required' => true,
    'rows' => '2'
    ])
    @formField('medias', [
    'label' => 'Default Timeline Meta Image',
    'name' => 'seo_timeline_image',
    'required' => true,
    ])
    @endformFieldset
@endsection

@push('extra_css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
@endpush
