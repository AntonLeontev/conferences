<?php

namespace Src\Domains\Conferences\Enums;

use App\Traits\ReturnsValues;

enum ReportForm: string
{
    use ReturnsValues;

    case oral = 'oral';
    case stand = 'stand';
    case mixed = 'mixed';
}
