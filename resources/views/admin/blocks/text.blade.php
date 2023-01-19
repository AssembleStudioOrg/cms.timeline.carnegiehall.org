@twillBlockTitle('Text Block')
@twillBlockIcon('text')
@twillBlockGroup('app')

@formField('wysiwyg', [
'name' => 'text',
'label' => 'Text',
'required' => true,
'toolbarOptions' => [
['header' => [2, 3, 4, 5, 6, false]],
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
