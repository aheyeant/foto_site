<?php


interface IService {

    public static function getById($id);

    public static function getAllRows();

    public static function update($item);

    public static function create($item);

    public static function delete($id);

}