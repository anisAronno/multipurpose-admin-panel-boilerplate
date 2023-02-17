<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum Format: string
{
    use EnumToArray;

    case STANDARD = 'Standard';
    case VIDEO = 'Video';
    case AUDIO = 'Audio';
    case GALLERY = 'Gallery';
    case IMAGE =  'Image'; 
}
