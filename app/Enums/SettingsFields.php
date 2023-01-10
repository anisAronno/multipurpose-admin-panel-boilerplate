<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SettingsFields: string
{
    use EnumToArray;

    case SITE_NAME =  "site_name";
    case SITE_TITLE =  "site_title";
    case ORGANIZATION_NAME =  "organization_name";
    case SITE_URL =  "site_url";
    case LOGO =  "logo";
    case BANNER =  "banner";
    case FAVICON =  "fav_icon";
    case ADDRESS =  "address";
    case EMAIL =  "email";
    case PHONE =  "phone";
    case TIME_ZONE =  "time_zone";
    case USER_DEFAULT_ROLE =  "user_default_role";
    case ANY_ONE_CAN_REGISTER =  "any_one_can_register";
    case IS_ACTIVE_SSO =  "is_active_sso";
    case SSO_FIELDS =  "sso_fields";
    case PAGINATION_LIMIT =  "pagination_limit";
    case USER_DEFAULT_STATUS =  "user_default_status";
}
