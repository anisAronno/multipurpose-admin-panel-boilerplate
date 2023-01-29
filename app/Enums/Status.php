<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Status: string
{
    use EnumToArray;

    case ACTIVE = 'Active';
    case PENDING = 'Pending';
    case DRAFT =  'Draft';
    case REJECTED = 'Rejected';
}
