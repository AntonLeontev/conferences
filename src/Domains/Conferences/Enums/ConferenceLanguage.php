<?php

namespace Src\Domains\Conferences\Enums;

enum ConferenceLanguage: string
{
    case ru = 'ru';
    case en = 'en';
    case mixed = 'mixed';
    case other = 'other';
}
