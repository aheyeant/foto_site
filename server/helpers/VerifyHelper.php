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

    /**
     * Remove all whitespaces
     *
     * @param $str - string
     * @return string
     */
    public static function removeWhitespaces($str): string
    {
        if (!isset($str)) return "";
        return preg_replace("/\s+/", "", $str);
    }

    /**
     * Transform to lower case
     *
     * @param $str - string
     * @return string
     */
    public static function toLowerCase($str): string
    {
        if (!isset($str)) return "";
        return strtolower($str);
    }

    /**
     * Remove all whitespaces and transform to lower case
     *
     * @param $str - string
     * @return string
     */
    public static function removeWhitespacesAndTransformToLowerCase($str): string
    {
        if (!isset($str)) return "";
        $str = self::removeWhitespaces($str);
        $str = self::toLowerCase($str);
        return $str;
    }
}