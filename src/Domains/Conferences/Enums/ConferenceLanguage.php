<?php

namespace Src\Domains\Conferences\Enums;

use App\Traits\ReturnsValues;

enum ConferenceLanguage: string
{
    use ReturnsValues;

    case ru = 'ru';
    case en = 'en';
    case mixed = 'mixed';
    case other = 'other';
}
