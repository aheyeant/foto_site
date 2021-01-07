<?php


class UserVerifyHelper {

    /**
     * Validates the input before setting it to the user
     *
     * @param $username
     * @param $email
     * @param $password
     * @param $phone
     * @param $role
     * @param $verified
     * @param $blocked
     * @return array - ["success" => true|false,
     *                      if (true):  "object" => User
     *                      if (false): "object" => error_log: ["username" => log|null,
     *                                                          "email" => log|null,
     *                                                          "password" => log|null,
     *                                                          "phone" => log|null,
     *                                                          "other" => log|null]
     *                ]
     */
    public static function createAndVerifyUser($username, $email, $password, $phone, $role, $verified, $blocked): array
    {
        $error_log = ["username" => null, "email" => null, "password" => null, "phone" => null, "other" => null];
        if (!self::verifyRole(VerifyHelper::removeWhitespaces($role))) {
            $error_log["other"] = "Server error.";
            return ["success" => false, "object" => $error_log];
        }

        $error = false;

        $username = VerifyHelper::removeWhitespacesAndTransformToLowerCase($username);
        $email = VerifyHelper::removeWhitespacesAndTransformToLowerCase($email);
        $password = VerifyHelper::removeWhitespaces($password);
        $phone = VerifyHelper::removeWhitespaces($phone);
        if ($phone == "") $phone = null;

        // TODO update error text
        if (!self::verifyUsername($username)) {$error = true; $error_log["username"] = "Incorrect username";}
        if (!self::verifyEmail($email))       {$error = true; $error_log["email"] = "Incorrect email";}
        if (!self::verifyPassword($password)) {$error = true; $error_log["password"] = "Password must be at least " . HelpersConstants::$PASSWORD_MIN_LENGTH . " characters";}
        if (!self::verifyPhone($phone))       {$error = true; $error_log["phone"] = "Incorrect phone number";}

        if ($error) {
            return ["success" => false, "object" => $error_log];
        }
        return ["success" => true, "object" => new User(null, $username, $email, $password, $phone, $role, $verified, $blocked)];
    }

    /**
     * Only lowercase characters, numbers and [_]; without spaces
     *
     * @param $username
     * @return bool
     */
    public static function verifyUsername($username): bool
    {
        if (!isset($username) || $username == "") return false;
        if (strlen($username > HelpersConstants::$USERNAME_MAX_LENGTH)) return false;
        return (preg_match('/^[a-z0-9_]+$/', $username));
    }

    /**
     * @param $email
     * @return bool
     */
    public static function verifyEmail($email): bool
    {
        if (!isset($email) || $email == "") return false;
        if (strlen($email) > HelpersConstants::$EMAIL_MAX_LENGTH) return false;
        // TODO verifyEmail implement
        return true;
    }

    /**
     * @param $password
     * @return bool
     */
    public static function verifyPassword($password): bool
    {
        if (!isset($password) || $password == "") return false;
        if (strlen($password) > HelpersConstants::$PASSWORD_MAX_LENGTH) return false;
        return (strlen($password) >= HelpersConstants::$PASSWORD_MIN_LENGTH);
    }

    /**
     * Valid phone number([0-9]*) or null
     *
     * @param $phone
     * @return bool
     */
    public static function verifyPhone($phone): bool
    {
        if ($phone == null) return true;
        if (strlen($phone) > HelpersConstants::$PHONE_MAX_LENGTH || strlen($phone) < HelpersConstants::$PHONE_MIN_LENGTH) return false;
        return (preg_match('/^[0-9]+$/', $phone));
    }

    /**
     * @param $role
     * @return bool
     */
    public static function verifyRole($role): bool
    {
        if (!isset($role) || $role == "") return false;
        switch ($role) {
            case DBConstants::$ROLE_USER:
            case DBConstants::$ROLE_ADMIN:
                return true;
            default:
                return false;
        }
    }

}