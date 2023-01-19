<?php

return [
  'enabled' => [
    'settings' => true,
    'site-link' => true,
  ],
  'migrations_use_big_integers' => true,
  'dashboard' => [
    'modules' => [
      \App\Models\Story::class => [
        'name' => 'stories',
        'label' => 'Stories',
        'label_singular' => 'Story',
        'search' => true,
        'search_fields' => [
          'title',
          'seo_title',
          'seo_description',
        ],
        'draft' => true,
        'count' => true,
        'create' => true,
        'activity' => true,
      ],
      \App\Models\Genre::class => [
        'name' => 'genres',
        'label' => 'Genres',
        'label_singular' => 'Genre',
        'count' => true,
        'create' => true,
        'draft' => true,
        'activity' => true,
        'search' => true,
        'search_fields' => [
          'name',
          'tradition',
          'seo_title',
          'seo_description',
          'hero_caption',
          'hero_credit',
          'hero_credit_link'
        ]
      ],
      \App\Models\NotablePerformer::class => [
        'name' => 'notablePerformers',
        'label' => 'Performers',
        'label_singular' => 'Performer',
        'search' => true,
        'search_fields' => ['name'],
        'count' => true,
        'create' => true,
        'activity' => true,
      ],
      \App\Models\Song::class => [
        'name' => 'songs',
        'label' => 'Songs',
        'label_singular' => 'Song',
        'search' => true,
        'search_fields' => ['title'],
        'count' => true,
        'create' => true,
        'activity' => true,
      ]
    ],
  ],
  'media_library' => [
    'extra_metadatas_fields' => [
      ['name' => 'identifier', 'label' => 'Identifier']
    ]
  ],
];
