<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Model;

class GlobalFooter extends Model
{
  use HasBlocks;
  use HasMedias;

  protected $fillable = [
    'published',
    'title',
    'blurb',
    'footnote',
    'legal_name',
  ];

  public $mediasParams = [
    'logo' => [
      'default' => [
        [
          'name' => 'default'
        ],
      ],
    ],
    'association_logo' => [
      'default' => [
        [
          'name' => 'default'
        ]
      ]
    ]
  ];
}
