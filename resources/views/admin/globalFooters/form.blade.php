@extends('twill::layouts.form', ['contentFieldsetLabel' => 'Footer Content'])

@section('contentFields')

@formField('wysiwyg', [
'name' => 'blurb',
'label' => 'Blurb',
'required' => true,
'toolbarOptions' => [
'bold',
'italic',
'link',
'clean'
]
])

@formField('wysiwyg', [
'name' => 'footnote',
'label' => 'Footnote',
'required' => true,
'toolbarOptions' => [
'bold',
'italic',
'link',
'clean'
]
])

@formField('medias', [
'name' => 'logo',
'label' => 'Cargnegie Hall Logo',
'note' => 'NB: logo should be white as it\'s on a black background',
'required' => true
])

@formField('medias', [
'name' => 'association_logo',
'label' => 'Association Logo',
'note' => 'NB: logo should be white as it\'s on a black background',
'required' => false
])

@formField('input', [
'name' => 'legal_name',
'label' => 'Legal Name',
'note' => 'NB: used for copyright notice',
'maxlength' => 100
])

<p style="font-size:14px;padding:8px;background:#ffffbd;">The overview content editor is below. NB: Only the first item
  is used.</p>

@formField('block_editor', [
'label' => 'Overview Content',
'withoutSeparator' => true,
'blocks' => ['image-and-text']
])
@stop
