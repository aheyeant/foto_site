<?php


require_once "ITDO.php";
require_once "database/core.php";


class UserTDO implements ITDO {

    public $user_id;
    public $user_login;
    public $user_email;
    public $user_password;
    public $user_phone_number;
    public $user_role;
    public $is_loaded = false;


    /**
     * UserTDO constructor.
     * @param $user_id
     * @param $user_login
     * @param $user_email
     * @param $user_password
     * @param $user_phone_number
     * @param $user_role
     */
    public function __construct($user_id, $user_login, $user_email, $user_password, $user_phone_number, $user_role)
    {
        $this->user_id = $user_id;
        $this->user_login = $user_login;
        $this->user_email = $user_email;
        $this->user_password = $user_password;
        $this->user_phone_number = $user_phone_number;
        $this->user_role = $user_role;
        if (isset($this->user_id)) $this->is_loaded = true;
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
            return $this->user_role == TDOConstants::$ROLE_ADMIN;
        }
        return false;
    }

    /**
     * Is needed to be checked with function self::isLoaded()
     * @param $id
     * @return UserTDO
     */
    public static function getById($id): UserTDO
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM users WHERE id = :id";
        $response = $db->getRow($query, ['id' => $id]);
        $db->close();
        if ($response == null) return self::getEmptyUserTDO();
        return self::initFromDBResponse($response);
    }

    /**
     * Is needed to be checked with function self::isLoaded()
     * @param $login
     * @return UserTDO
     */
    public static function getByLogin($login): UserTDO
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM users WHERE login = :login";
        $response = $db->getRow($query, ['login' => $login]);
        $db->close();
        if ($response == null) return self::getEmptyUserTDO();
        return self::initFromDBResponse($response);
    }

    /**
     * @return array
     */
    public static function getAllRows(): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM users";
        $response = $db->getMultiplyRows($query, null);
        $db->close();
        if ($response == null) return [];
        $content = [];
        foreach ($response as $item) {
            $content[] = self::initFromDBResponse($item);
        }
        return $content;
    }

    /**
     * @param $iTDO
     */
    public static function update($iTDO)
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "UPDATE users SET login = :login, email = :email, password = :password, phone_number = :phone_number, role = :role WHERE id = :id";
        $db->update($query, ['id' => $iTDO->user_id, 'login' => strtolower($iTDO->user_login), 'email' => $iTDO->user_email, 'password' => $iTDO->user_password, 'phone_number' => $iTDO->user_phone_number, 'role' => $iTDO->user_role]);
        $db->close();
    }

    /**
     * @param $iTDO
     * @return array
     */
    public static function create($iTDO): array
    {
        $encryptedPassword = password_hash($iTDO->user_password, PASSWORD_DEFAULT);
        $iTDO->user_password = $encryptedPassword;
        $db = new MySQLDatabase();
        $db->connect();
        $query = "INSERT INTO users (login, email, password, phone_number, role) VALUES (:login, :email, :password, :phone_number, :role)";
        $result = $db->add($query, ['login' => strtolower($iTDO->user_login), 'email' => $iTDO->user_email, 'password' => $iTDO->user_password, 'phone_number' => $iTDO->user_phone_number, 'role' => $iTDO->user_role]);
        $db->close();
        if ($result["success"]) {
            $result["object"] = self::getByLogin($iTDO->user_login);
            return $result;
        } else {
            return $result;
        }
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }


    private static function initFromDBResponse($response): UserTDO
    {
        return new UserTDO(null, $response["user_login"], $response["user_email"], $response["user_password"], $response["user_phone_number"], $response["user_role"]);
    }

    private static function getEmptyUserTDO(): UserTDO
    {
        return new UserTDO(null, null, null, null, null, null);
    }
}