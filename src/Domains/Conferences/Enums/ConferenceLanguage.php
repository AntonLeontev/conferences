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

    public function locale()
    {
        return match ($this) {
            self::ru => 'ru',
            self::en => 'en',
            self::mixed => 'en',
            self::other => 'en',
        };
    }
}
