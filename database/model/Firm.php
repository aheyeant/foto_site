<?php

class Firm {

    public $id;
    public $name;
    public $is_loaded = false;

    /**
     * Firm constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
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
     * @param $response
     * @return Firm
     */
    public static function initFirmFromDBResponse($response): Firm
    {
        $id = null;
        $name = null;
        if (isset($response["id"])) $id = $response["id"];
        if (isset($response["name"])) $name = $response["name"];
        if (!isset($id) or !isset($name)) {
            return self::initEmptyFirm();
        }
        return new Firm($id, $name);
    }

    /**
     * @return Firm
     */
    public static function initEmptyFirm(): Firm
    {
        return new Firm(null, null);
    }

}