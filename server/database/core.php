<?php

// MYSQL
class MySQLDatabase
{
    //linux
    private $db_login = "phpmyadmin";   // login
    private $db_pass = "1234";          // password

    //server
    //private $db_login = "skalkste";           // login
    //private $db_pass = "webove aplikace";     // password

    private $db_name = "skalkste";      // db name
    private $db_host = "localhost";     // host

    private $pdo;

    function connect() {
        try {
            $this->pdo = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_login, $this->db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        //$this->pdo = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_login, $this->db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }

    function close() {
        $this->pdo = null;
    }

    /**
     * @param $query - SQL query ("SELECT * FROM `category` WHERE `id` = :id")
     * @param $data - may by array (array('id' => '21'))
     * @return array
     */
    function getRow($query, $data)
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($data);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $query - SQL query ("SELECT * FROM `category` WHERE `id` = :id")
     * @param $data - may by array (array('id' => '21'))
     * @return array
     */
    function getMultiplyRows($query, $data)
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($data);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $query - SQL query ("UPDATE `category` SET `name` = :name WHERE `id` = :id")
     * @param $data - may by array (array('name' => 'grape', 'id' => 22))
     * @return array - {
     *                   "success" => bool,
     *                      if (true)  "object" => "SUCCESS",
     *                      if (false) "object" => log
     *                 }
     */
    function update($query, $data): array
    {
        $statement = $this->pdo->prepare($query);
        $ret = $statement->execute($data);
        if ($ret == null) return ["success" => false, "object" => $statement->errorInfo()];
        return ["success" => true, "object" => "SUCCESS"];
    }

    /**
     * @param $query - SQL query ("INSERT INTO `categories` (`name`) VALUES (:name)")
     * @param $data - may by array (array('name' => 'grape')
     * @return array - {
     *                   "success" => bool,
     *                      if (true)  "object" => "SUCCESS",
     *                      if (false) "object" => log
     *                 }
     */
    function add($query, $data): array
    {
        $statement = $this->pdo->prepare($query);
        $ret = $statement->execute($data);
        if ($ret == null) return ["success" => false, "object" => $statement->errorInfo()];
        return ["success" => true, "object" => "SUCCESS"];
    }

    /**
     * @param $query
     * @param $data
     * @return array - {
     *                   "success" => bool",
     *                   "object" => log
     *                 }
     */
    function delete($query, $data): array
    {
        $statement = $this->pdo->prepare($query);
        $ret = $statement->execute($data);
        if ($ret == null) return ["success" => false, "object" => $statement->errorInfo()];
        return ["success" => true, "log" => "Item was deleted"];
    }
}