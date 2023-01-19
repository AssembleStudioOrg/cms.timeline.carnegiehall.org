@twillBlockTitle('Block Quote')
@twillBlockIcon('quote')
@twillBlockGroup('app')

@formField('wysiwyg', [
'name' => 'quote',
'label' => 'Quote',
'placeholder' => 'e.g. Music has always been integral of the African American struggle for Freedom.',
'required' => true,
'maxlength' => 400,
'toolbarOptions' => [
'bold',
'clean'
],
])

@formField('input', [
'name' => 'person',
'label' => 'Person',
'placeholder' => 'e.g. Bernice Johnson Reagan',
'maxlength' => 80,
])

@formField('input', [
'name' => 'title',
'label' => 'Title',
'placeholder' => 'e.g. Singer & Civil Rights Activist',
'maxlength' => 80,
])
