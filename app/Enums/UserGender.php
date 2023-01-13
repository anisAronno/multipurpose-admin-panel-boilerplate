<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserGender: string
{
    use EnumToArray;

    case MALE = 'Male';
    case FEMALE = 'Female';
    case OTHERS = 'Others';
}
