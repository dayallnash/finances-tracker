<?php


namespace App\Helper;

/**
 * Class CardHelper
 *
 * @package App\Helper
 */
class CardHelper
{
    /**
     * @param $longNumber
     * @return string
     */
    public static function formatLongNumber(?string $longNumber): ?string
    {
        if ($longNumber === null) {
            return null;
        }

        return implode(' ', str_split($longNumber, 4));
    }
}