@twillBlockTitle('Map')
@twillBlockIcon('location')

<br />

@formField('input', [
'name' => 'map_center_lat',
'label' => 'Map Center Latitude',
'maxlength' => 10,
])

@formField('input', [
'name' => 'map_center_lng',
'label' => 'Map Center Longitude',
'maxlength' => 10,
])

@formField('repeater', ['type' => 'map-item'])
