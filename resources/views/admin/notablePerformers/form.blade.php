@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
    'name' => 'name',
    'type' => 'text',
    'label' => 'Name',
    'maxlength' => 255,
    'required' => true
    ])

    @formField('medias', [
    'name' => 'image',
    'label' => 'Image',
    'required' => true
    ])

    @formField('input', [
    'name' => 'attribution',
    'type' => 'text',
    'label' => 'Attribution',
    'maxlength' => 255,
    'required' => false
    ])

    @formField('input', [
    'name' => 'ch_agent_id',
    'type' => 'text',
    'label' => 'Agent ID',
    'maxlength' => 255,
    'required' => false
    ])

    @formField('checkbox', [
    'name' => 'show_in_menu',
    'label' => 'Display performer in menu'
    ])
@stop

@section('sideFieldsets')
    @include('admin/_includes/seo')

    @if (count($item->songs))
        <a17-fieldset title="Linked Songs">
            <div class="custom-table">
                <table class="table" id="songs-table">
                    <tbody>
                        @foreach ($item->songs as $song)
                            <tr>
                                <td width="60"><img src="{{ $song->cmsImage() }}" alt="{{ $song->title }}" width="60"
                                        height="60" />
                                </td>
                                <td>{{ $song->title }}</td>
                                <td align="right"><a href="{{ route('admin.songs.edit', $song) }}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </a17-fieldset>
    @endif

    @include('admin/_includes/api-link', ['name' => 'notable-performers'])
@endsection

@push('extra_css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
@endpush
