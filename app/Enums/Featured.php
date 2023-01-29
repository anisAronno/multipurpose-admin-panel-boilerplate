<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Featured: string
{
    use EnumToArray;

    case OK = '1';
    case NOT = '0';
}
