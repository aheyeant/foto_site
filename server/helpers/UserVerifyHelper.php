<?php

$__ROOT__ = dirname(dirname(__FILE__));

require_once($__ROOT__."/Constants.php");
require_once($__ROOT__."/database/model/User.php");
require_once($__ROOT__."/database/services/UserService.php");

class UserVerifyHelper {

    /**
     * Validates the input before setting it to the user
     *
     * Only for signUpPostController
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
     *                      if (false): "object" => null
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

        $_SESSION["signup_verify_old_username"] = $username;
        $_SESSION["signup_verify_old_email"] = $email;
        $_SESSION["signup_verify_old_phone"] = $phone;

        // TODO update error text
        if (!self::verifyUsername($username)) {$error = true; $_SESSION["signup_verify_log_username"] = "Incorrect username format";}
        if (!self::verifyEmail($email))       {$error = true; $_SESSION["signup_verify_log_email"] = "Incorrect email format";}
        if (!self::verifyPassword($password)) {$error = true; $_SESSION["signup_verify_log_password"] = "Password must be at least " . Constants::$PASSWORD_MIN_LENGTH . " characters";}
        if (!self::verifyPhone($phone))       {$error = true; $_SESSION["signup_verify_log_phone"] = "Incorrect phone number format";}
        if ($verified) $verified = 1; else $verified = 0;
        if ($blocked) $blocked = 1; else $blocked = 0;

        if ($error) {
            $_SESSION["signup_verify_error"] = true;
            return ["success" => false, "object" => null];
        }

        if (self::verifyUsernameExist($username)) {$error = true; $_SESSION["signup_verify_log_username"] = "Username already exists";}
        if (self::verifyEmailExist($email))  {$error = true; $_SESSION["signup_verify_log_email"] = "Email already exists";}

        if ($error) {
            $_SESSION["signup_verify_error"] = true;
            return ["success" => false, "object" => null];
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
        if (strlen($username) > Constants::$USERNAME_MAX_LENGTH) return false;
        return (preg_match('/^[a-z0-9_]+$/', $username));
    }

    /**
     * @param $email
     * @return bool
     */
    public static function verifyEmail($email): bool
    {
        if (!isset($email) || $email == "") return false;
        if (strlen($email) > Constants::$EMAIL_MAX_LENGTH) return false;
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
        if (strlen($password) > Constants::$PASSWORD_MAX_LENGTH) return false;
        return (strlen($password) >= Constants::$PASSWORD_MIN_LENGTH);
    }

    /**
     * Valid phone number(+[0-9]*) or null
     *
     * @param $phone
     * @return bool
     */
    public static function verifyPhone($phone): bool
    {
        if ($phone == null) return true;
        if (strlen($phone) > Constants::$PHONE_MAX_LENGTH || strlen($phone) < Constants::$PHONE_MIN_LENGTH) return false;
        if ($phone[0] != "+") return false;
        return (preg_match('/^[0-9]+$/', substr($phone, 1)));
    }

    /**
     * @param $role
     * @return bool
     */
    public static function verifyRole($role): bool
    {
        if (!isset($role) || $role == "") return false;
        switch ($role) {
            case Constants::$ROLE_USER:
            case Constants::$ROLE_ADMIN:
                return true;
            default:
                return false;
        }
    }

    /**
     * @param $username
     * @return bool
     */
    public static function verifyUsernameExist($username): bool
    {
        $user = UserService::getByUsername($username);
        return $user->isLoaded();
    }

    /**
     * @param $email
     * @return bool
     */
    public static function verifyEmailExist($email): bool
    {
        $user = UserService::getByEmail($email);
        return $user->isLoaded();
    }
}