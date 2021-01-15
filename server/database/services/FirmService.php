<?php

$__ROOT__ = dirname(dirname(__FILE__));

require_once("IService.php");
require_once($__ROOT__."/core.php");
require_once($__ROOT__."/model/Firm.php");


class FirmService implements IService {

    /**
     * Is needed to be checked with function Firm::isLoaded()
     * @param $id
     * @return Firm
     */
    public static function getById($id): Firm
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM firms WHERE id = :id";
        $response = $db->getRow($query, ['id' => $id]);
        $db->close();
        if ($response == null) return Firm::initEmptyFirm();
        return Firm::initFirmFromDBResponse($response);
    }

    /**
     * Is needed to be checked with function Firm::isLoaded()
     * @param $name
     * @return Firm
     */
    public static function getByName($name): Firm
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM firms WHERE name = :name";
        $response = $db->getRow($query, ['name' => $name]);
        $db->close();
        if ($response == null) return Firm::initEmptyFirm();
        return Firm::initFirmFromDBResponse($response);
    }

    /**
     * @return array
     */
    public static function getAllRows(): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM firms ORDER BY id";
        $response = $db->getMultiplyRows($query, null);
        $db->close();
        if ($response == null) return [];
        $content = [];
        foreach ($response as $item) {
            $content[] = Firm::initFirmFromDBResponse($item);
        }
        return $content;
    }

    /**
     * @param $item - Firm
     */
    public static function update($item)
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "UPDATE firms SET name = :name WHERE id = :id";
        $db->update($query, ['id' => $item->id,
                             'name' => ($item->name)]);
        $db->close();
    }

    /**
     * @param $item - Firm
     * @return array
     */
    public static function create($item): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "INSERT INTO firms (name) VALUES (:name)";
        $result = $db->add($query, ['name' => $item->name]);
        $db->close();
        if ($result["success"]) {
            $result["object"] = self::getByName($item->name);
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