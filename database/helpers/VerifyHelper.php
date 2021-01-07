<?php


class VerifyHelper {

    /**
     * Check if $integer is integer
     * @param $integer
     * @return bool
     */
    public static function verifyInteger($integer): bool
    {
        return is_int($integer);
    }

    /**
     * Check if $integer is unsigned integer
     * @param $integer
     * @return bool
     */
    public static function verifyUnsignedInteger($integer): bool
    {
        if (!is_int($integer)) {
            return false;
        }
        return $integer >= 0;
    }

}