<?php


interface ITDO {
    public static function getById($id);

    public static function getAllRows();

    public static function update($iTDO);

    public static function create($iTDO);

    public static function delete($id);

}