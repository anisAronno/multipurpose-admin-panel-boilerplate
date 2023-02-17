<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Type: string
{
    use EnumToArray;
 
    case PHYSICAL = 'Physical';
    case DOWNLOADABLE = 'Downloadable'; 
    case COURSE = 'Course'; 
    case VIRTUAL = 'VIRTUAL'; 
}
