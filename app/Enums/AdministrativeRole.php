<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AdministrativeRole: string
{
    use EnumToArray;

    case SUPERADMIN =  "1";
    case ADMIN =  "2";
    case EDITOR =  "3";
    case AUTHOR =  "4";
    case USER =  "5";
}
