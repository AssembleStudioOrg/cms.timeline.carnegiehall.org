@twillBlockTitle('Item')
@twillBlockIcon('b-checklist')
@twillRepeaterTrigger('Add new item')

@formField('input', [
'name' => 'title',
'label' => 'Title',
'type' => 'text'
])

@formField('wysiwyg', [
'name' => 'content',
'label' => 'Content',
'toolbarOptions' => ['bold', 'italic', 'link']
])
