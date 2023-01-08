<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AllowedFileType: string
{
    use EnumToArray;

    case JPEG =  "jpeg";
    case JPG =  "jpg";
    case PNG =  "png";
    case GIF =  "gif";
    case SVG =  "svg";
    case WEBP =  "webp";
}
