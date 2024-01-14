<?php

namespace Src\Domains\Conferences\Enums;

use App\Traits\ReturnsValues;

enum ConferenceFormat: string
{
    use ReturnsValues;

    case national = 'national';
    case international = 'international';
}
