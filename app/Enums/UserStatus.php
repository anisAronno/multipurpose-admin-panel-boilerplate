<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserStatus: string
{
    use EnumToArray;

    case ACTIVE = 'Active';
    case PENDING = 'Pending';
    case BLOCK = 'Block';
    case BANNED = 'Banned';
    case COMPLETED = 'Completed';
    case UNCOMPLETED = 'Uncompleted';
    case REJECTED = 'Rejected';
}
