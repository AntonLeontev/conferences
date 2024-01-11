<?php

namespace Src\Domains\Conferences\Enums;

enum ParticipantsNumber: string
{
    case under50 = '50-';
    case from50to100 = '50-100';
    case from100to200 = '100-200';
    case over200 = '200+';
}
