<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SettingsFields: string
{
    use EnumToArray;

    case SITE_NAME = 'site_name';
    case SITE_TITLE = 'site_title';
    case ORGANIZATION_NAME = 'organization_name';
    case SITE_URL = 'site_url';
    case LOGO = 'logo';
    case BANNER = 'banner';
    case FAVICON = 'fav_icon';
    case ADDRESS = 'address';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case TIME_ZONE = 'time_zone';
    case LANGUAGE = 'language';
    case USER_DEFAULT_ROLE = 'user_default_role';
    case ANY_ONE_CAN_REGISTER = 'any_one_can_register';
    case ALLOW_SOCIAL_LOGIN = 'allow_social_login';
    case SOCIAL_LOGIN_FIELDS = 'social_login_fields';
    case PAGINATION_LIMIT = 'pagination_limit';
    case USER_DEFAULT_STATUS = 'user_default_status';
    case COLLECT_USER_LOCATION = 'collect_user_location';
    case MAP = 'map';
    case FACEBOOK_URL = 'facebook_url';
    case INSTAGRAM_URL = 'instagram_url';
    case TWITTER_URL = 'twitter_url';
    case YOUTUBE_CHANNEL_URL = 'youtube_channel_url';
    case LINKEDIN_URL = 'linkedin_url';
    case GITHUB_URL = 'github_url';
    case MODEL_ONE = 'model_one';
    case MODEL_TWO = 'model_two';
    case MODEL_THREE = 'model_three';
    case MODEL_FOUR = 'model_four';
}
