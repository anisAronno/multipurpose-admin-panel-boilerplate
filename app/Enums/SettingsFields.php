<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SettingsFields: string
{
    use EnumToArray;

    case SITE_NAME =  "site_name"; 
    case SITE_TITLE =  "site_title"; 
    case SITE_URL =  "site_url"; 
    case LOGO =  "logo"; 
    case BANNER =  "banner"; 
    case FAVICON =  "fav_icon"; 
    case ADDRESS =  "address"; 
    case EMAIL =  "email"; 
    case PHONE =  "phone"; 
    case TIME_ZONE =  "time_zone"; 
    case USER_DEFAULT_ROLE =  "user_defeult_role"; 
    case ANY_ONE_CAN_REGISTER =  "any_one_can_register"; 
    case PAGINATION_LIMIT =  "pagination_limit"; 
}
