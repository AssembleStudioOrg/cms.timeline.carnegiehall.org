@twillBlockTitle('Image or Video')
@twillBlockIcon('media')
@twillRepeaterTrigger('Add another Image OR Video')

@formField('medias', [
'name' => 'image',
'label' => 'Image',
'note' => 'Minimum image width 600px'
])

@formField('browser', [
'moduleName' => 'musicVideos',
'name' => 'musicVideos',
'label' => 'Apple Music Video',
'max' => 1
])

@formField('input', [
'name' => 'vimeo_url',
'label' => 'Vimeo URL',
'type' => 'text'
])

@formField('input', [
'name' => 'youtube_url',
'label' => 'Youtube URL',
'type' => 'text'
])

@formField('files', [
'name' => 'video',
'label' => 'Video file',
'note' => 'Fallback video file',
'noTranslate' => true
])

@formField('wysiwyg', [
'name' => 'caption',
'label' => 'Caption',
'toolbarOptions' => ['bold', 'italic', 'link']
])

@formField('input', [
'name' => 'credit',
'label' => 'Credit',
'type' => 'text'
])

@formField('input', [
'name' => 'credit_link',
'label' => 'Credit link',
'placeholder' => 'e.g. https://www.example.com',
'type' => 'text'
])
