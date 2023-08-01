<?php

namespace App\Helpers;

class Helpers
{
    /**
    * Converts a variable number of strings to an integer between 0 and 99999.
    *
    * @param string ...$strings The strings to be converted.
    * @return int The integer representation of the concatenated strings.
    */
    public static function stringToInteger(...$strings)
    {
        $concatenatedString = implode('', $strings);
        $asciiSum = 0;
        foreach (str_split($concatenatedString) as $char) {
            $asciiSum += ord($char);
        }
        $shortNumber = $asciiSum % 100000;
        if($shortNumber < 100) {
            return rand(11, 9999);
        }

        return $shortNumber;
    }

}
