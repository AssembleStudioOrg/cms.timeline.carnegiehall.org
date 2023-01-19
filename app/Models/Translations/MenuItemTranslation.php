<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\MenuItem;

class MenuItemTranslation extends Model
{
    protected $baseModuleModel = MenuItem::class;
}
