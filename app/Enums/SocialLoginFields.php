<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SocialLoginFields: string
{
    use EnumToArray;

    case GITHUB   =  "Github";
    case GOOGLE =  "Google";
    case FACEBOOK =  "Facebook";
    case LINKEDIN =  "Linkedin";
    case TWITTER =  "Twitter";
    case INSTAGRAM =  "Instagram";
}
