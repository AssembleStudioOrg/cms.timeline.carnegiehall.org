@formField('input', [
'name' => 'first_name',
'label' => 'First name',
'maxlength' => 100,
'required' => true
])

@formField('input', [
'name' => 'last_name',
'label' => 'Last name',
'maxlength' => 100,
'required' => true
])

@formField('wysiwyg', [
'name' => 'bio',
'label' => 'Bio',
'required' => false,
'maxlength' => 400,
'toolbarOptions' => [
'bold',
'italic',
'link',
'clean'
],
])

@formField('input', [
'name' => 'external_link',
'label' => 'External Link',
'maxlength' => 200,
'placeholder' => 'e.g. https://www.example.com',
'required' => false
])
