<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Featured: string
{
    use EnumToArray;

    case OK = 'Featured';
    case NOT = 'N/A';
}
