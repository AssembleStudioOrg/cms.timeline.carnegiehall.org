@twillBlockTitle('Info Text Block')
@twillBlockIcon('text')
@twillBlockGroup('app')

@formField('wysiwyg', [
'name' => 'text',
'label' => 'Text',
'note' => 'Commonly used as bibliographic sources.',
'required' => true,
'toolbarOptions' => [
'bold',
'italic',
['list' => 'bullet'],
['list' => 'ordered'],
['script' => 'super'],
['script' => 'sub'],
'link',
'clean'
]
])
