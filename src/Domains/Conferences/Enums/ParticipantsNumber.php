<?php

namespace Src\Domains\Conferences\Enums;

use App\Traits\ReturnsValues;

enum ParticipantsNumber: string
{
    use ReturnsValues;

    case under50 = '50-';
    case from50to100 = '50-100';
    case from100to200 = '100-200';
    case over200 = '200+';
}
