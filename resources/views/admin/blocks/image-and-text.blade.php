@twillBlockTitle('Image & Text Block')
@twillBlockIcon('image')
@twillBlockGroup('app')

@formField('medias', [
'name' => 'image',
'label' => 'Image',
'note' => 'Minimum image width 600px'
])

@formField('wysiwyg', [
'name' => 'image_caption',
'label' => 'Image Caption',
'toolbarOptions' => [
'bold',
'italic',
'link',
'clean'
]
])

@formField('input', [
'name' => 'image_credit',
'label' => 'Image Credit',
'maxlength' => 80,
])

@formField('input', [
'name' => 'image_credit_link',
'label' => 'Credit link',
'maxlength' => 200,
])

@formField('wysiwyg', [
'name' => 'text',
'label' => 'Text',
'required' => true,
'toolbarOptions' => [
'bold',
'italic',
'blockquote',
['list' => 'bullet'],
['list' => 'ordered'],
['script' => 'super'],
['script' => 'sub'],
'link',
'clean'
]
])
