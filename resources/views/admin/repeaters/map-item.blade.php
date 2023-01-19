@twillBlockTitle('Map Pin')
@twillBlockIcon('location')
@twillRepeaterTrigger('Add a pin')

@formField('input', [
    'name' => 'name',
    'label' => 'Name',
    'maxlength' => 200,
])

@formField('input', [
    'name' => 'url',
    'label' => 'URL',
    'maxlength' => 200,
])

@formField('input', [
    'name' => 'lat',
    'label' => 'Latitude',
    'maxlength' => 10,
])

@formField('input', [
    'name' => 'lng',
    'label' => 'Longitude',
    'maxlength' => 10,
])
