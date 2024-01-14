<?php

namespace Src\Domains\Conferences\Enums;

use App\Traits\ReturnsValues;

enum AbstractsLanguage: string
{
    use ReturnsValues;

    case ru = 'ru';
    case en = 'en';
}
