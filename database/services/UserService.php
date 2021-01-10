<?php

require_once "IService.php";
require_once "database/core.php";
require_once "database/model/User.php";


class UserService implements IService {

    /**
     * Is needed to be checked with function User::isLoaded()
     * @param $id
     * @return User
     */
    public static function getById($id): User
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM users WHERE id = :id";
        $response = $db->getRow($query, ['id' => $id]);
        $db->close();
        if ($response == null) return User::initEmptyUser();
        return User::initUserFromDBResponse($response);
    }

    /**
     * Is needed to be checked with function User::isLoaded()
     * @param $username
     * @return User
     */
    public static function getByUsername($username): User
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM users WHERE username = :username";
        $response = $db->getRow($query, ['username' => $username]);
        $db->close();
        if ($response == null) return User::initEmptyUser();
        return User::initUserFromDBResponse($response);
    }

    /**
     * Is needed to be checked with function User::isLoaded()
     * @param $email
     * @return User
     */
    public static function getByEmail($email): User
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM users WHERE email = :email";
        $response = $db->getRow($query, ['email' => $email]);
        $db->close();
        if ($response == null) return User::initEmptyUser();
        return User::initUserFromDBResponse($response);
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
            $content[] = User::initUserFromDBResponse($item);
        }
        return $content;
    }

    /**
     * Update existing user
     *
     * @param $item - User class
     */
    public static function update($item)
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "UPDATE users SET username = :username, email = :email, password = :password, phone = :phone, role = :role, verified = :verified, blocked = :blocked WHERE id = :id";
        $db->update($query, ['id' => $item->id,
                             'username' => strtolower($item->username),
                             'email' => $item->email,
                             'password' => $item->password,
                             'phone' => $item->phone,
                             'role' => $item->role,
                             'verified' => $item->verified,
                             'blocked' => $item->blocked]);
        $db->close();
    }

    /**
     * Create new user
     *
     * don't check if $item is valid, must be checked until
     * @param $item
     * @return array
     */
    public static function create($item): array
    {
        $encryptedPassword = password_hash($item->password, PASSWORD_DEFAULT);
        $item->password = $encryptedPassword;
        $db = new MySQLDatabase();
        $db->connect();
        $query = "INSERT INTO users (username, email, password, phone, role, verified, blocked) VALUES (:username, :email, :password, :phone, :role, :verified, :blocked)";
        $result = $db->add($query, ['username' => strtolower($item->username),
                                    'email' => $item->email,
                                    'password' => $item->password,
                                    'phone' => $item->phone,
                                    'role' => $item->role,
                                    'verified' => $item->verified,
                                    'blocked' => $item->blocked]);
        $db->close();
        if ($result["success"]) {
            $result["object"] = self::getByUsername($item->username);
            return $result;
        } else {
            return $result;
        }
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }


}