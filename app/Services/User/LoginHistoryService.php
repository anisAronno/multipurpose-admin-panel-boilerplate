<?php

namespace App\Services\User;

use Stevebauman\Location\Facades\Location;

class LoginHistoryService
{
    /**
     * Summary of get user Location
     * @param mixed $ip
     * @return array
     */
    public static function getLocation($ip): array
    {
        if ($location = Location::get($ip)) {
            return self::getFields($location);
        } else {
            return [];
        }
    }

    /**
     * Summary of get user login detailsFields
     * @param mixed $location
     * @return array
     */

    public static function getFields($location): array
    {
        $data = [];

        $data['ip']             = $location->ip ?? "";
        $data['country_name']   = $location->countryName ?? "";
        $data['country_code']   = $location->countryCode ?? "";
        $data['region_code']    = $location->regionCode ?? "";
        $data['region_name']    = $location->regionName ?? "";
        $data['city_name']      = $location->cityName ?? "";
        $data['zip_code']       = $location->zipCode ?? "";
        $data['latitude']       = $location->latitude ?? "";
        $data['longitude']      = $location->longitude ?? "";
        $data['time_zone']      = $location->timezone ?? "";
        $data['area_code']       = $location->areaCode ?? "";
        $data['metro_code']     = $location->metroCode ?? "";
        $data['iso_code']       = $location->isoCode ?? "";
        $data['postal_code']    = $location->postalCode ?? "";

        return $data;
    }
}
