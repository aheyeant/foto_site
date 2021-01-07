<?php


class UserVerifyHelper {

    public static function verifyUsername($username): bool
    {
        // TODO implement
        return true;
    }


    public static function verifyEmail($email): bool
    {
        // TODO implement
        return true;
    }

    public static function verifyPhone($phone): bool
    {
        // TODO implement
        return true;
    }

    /**
     * @param $role
     * @return bool
     */
    public static function verifyRole($role): bool
    {
        switch ($role)
        {
            case DBConstants::$ROLE_USER:
            case DBConstants::$ROLE_ADMIN:
                return true;
            default:
                return false;
        }
    }

}