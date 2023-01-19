<a17-fieldset title="SEO" id="seo">
    @formField('input', [
    'label' => 'Title',
    'name' => 'seo_title',
    'maxlength' => '80'
    ])
    @formField('medias', [
    'name' => 'seo_image',
    'label' => 'Image',
    'note' => 'Minimum image width 600px'
    ])
    @formField('input', [
    'type' => 'textarea',
    'label' => 'Description',
    'name' => 'seo_description',
    'rows' => '3'
    ])
    @formField('input', [
    'label' => 'Keywords',
    'name' => 'seo_keywords',
    'maxlength' => '80'
    ])
</a17-fieldset>
