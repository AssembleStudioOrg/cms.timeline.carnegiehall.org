<?php

return [

  'more' => [
    'title' => 'Manage Content',
    'route' => 'admin.more.stories.index',
    'primary_navigation' => [
      'pages' => [
        'title' => 'Pages',
        'module' => true,
      ],
      'stories' => [
        'title' => 'Stories',
        'module' => true
      ],
      'genres' => [
        'title' => 'Genres',
        'module' => true
      ],
      'notablePerformers' => [
        'title' => 'Performers',
        'module' => true
      ],
      'songs' => [
        'title' => 'Songs',
        'module' => true
      ],
      'musicVideos' => [
        'title' => 'Music Videos',
        'module' => true
      ],
      'authors' => [
        'title' => 'Authors',
        'module' => true
      ],
      'themes' => [
        'title' => 'Themes',
        'module' => true
      ],
      'instruments' => [
        'title' => 'Instruments',
        'module' => true
      ],
      'musicalFeatures' => [
        'title' => 'Musical Features',
        'module' => true
      ],
      'globalFooters' => [
        'title' => 'Global Footer',
        'route' => 'landing',
        'module' => true
      ],
      'siteSettings' => [
        'title' => 'Site Settings',
        'route' => 'landing',
        'module' => true
      ],
    ]
  ],
  'menus' => [
    'title' => 'Menus',
    'module' => true
  ],
  'deploy' => [
    'title' => 'Build & Deploy',
    'route' => 'admin.deploy'
  ],
  'settings' => [
    'title' => 'CMS Settings',
    'route' => 'admin.settings',
    'params' => ['section' => 'vercel'],
    'primary_navigation' => [
      'vercel' => [
        'title' => 'Vercel',
        'route' => 'admin.settings',
        'params' => ['section' => 'vercel']
      ],
      'preview' => [
        'title' => 'Preview',
        'route' => 'admin.settings',
        'params' => ['section' => 'preview']
      ],
      'apple-music-notifier' => [
        'title' => 'Apple Music Notifier',
        'customTitle' => 'test',
        'route' => 'admin.settings',
        'params' => ['section' => 'apple-music-notifier']
      ],
    ]
  ],
  'appleMusicStatus' => [
    'title' => 'Apple Music Notifier',
    'route' => 'admin.appleMusicStatus',
  ],
];
