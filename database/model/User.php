<?php


class User {

    public $id;
    public $username;
    public $email;
    public $password;
    public $phone;
    public $role;
    public $verified;
    public $blocked;
    public $is_loaded = false;


    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $email
     * @param $password
     * @param $phone
     * @param $role
     * @param $verified
     * @param $blocked
     */
    public function __construct($id, $username, $email, $password, $phone, $role, $verified, $blocked)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->role = $role;
        $this->verified = $verified;
        $this->blocked = $blocked;
        if (isset($this->id)) $this->is_loaded = true;
    }

    /**
     * @return bool
     */
    public function isLoaded(): bool
    {
        return $this->is_loaded;
    }

    /**
     * Checks if the user is an administrator
     * @return bool
     */
    public function isAdmin(): bool
    {
        if ($this->is_loaded) {
            return $this->role == DBConstants::$ROLE_ADMIN;
        }
        return false;
    }

    /**
     * Checks if the user account was verified
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->verified;
    }

    /**
     * Checks if the user account was blocked
     * @return bool
     */
    public function isBlocked(): bool
    {
        return $this->blocked;
    }


    /**
     * Is needed to be checked with function self::isLoaded()
     * @param $response - response from DB
     * @return User
     */
    public static function initUserFromDBResponse($response): User
    {
        $id = null;
        $username = null;
        $email = null;
        $password = null;
        $phone = null;
        $role = null;
        $verified = null;
        $blocked = null;
        $is_loaded = false;
        if (isset($response["id"])) $id = $response["id"];
        if (isset($response["username"])) $username = $response["username"];
        if (isset($response["email"]) ) $email = $response["email"];
        if (isset($response["password"]) ) $password = $response["password"];
        if (isset($response["phone"]) ) $phone = $response["phone"];
        if (isset($response["role"]) ) $role = $response["role"];
        if (isset($response["verified"]) ) $verified = $response["verified"];
        if (isset($response["blocked"]) ) $blocked = $response["blocked"];
        if (isset($id) and isset($username) and isset($email) and isset($password) and isset($role) and isset($verified) and isset($blocked)) $is_loaded = true;
        if ($is_loaded) {
            return new User($id, $username, $email, $password, $phone, $role, $verified, $blocked);
        }
        return self::initEmptyUser();
    }

    /**
     * @return User
     */
    public static function initEmptyUser(): User
    {
        return new User(null, null, null, null, null, null, null, null);
    }

}