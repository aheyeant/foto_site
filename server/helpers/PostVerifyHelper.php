<?php

$__ROOT__ = dirname(dirname(__FILE__));

require_once($__ROOT__."/database/model/Post.php");


class PostVerifyHelper {

    /**
     * Validates the input before setting it to the post
     *
     * @param $model
     * @param $price
     * @param $description
     * @param $photo_url
     * @param $available
     * @param $user_id
     * @param $firm_id
     * @return Post
     */
    public static function createAndVerifyPost($model, $price, $description, $photo_url, $available, $user_id, $firm_id): Post
    {
        $model = self::editModel($model);
        $price = self::editPrice($price);
        $description = self::editDescription($description);
        return new Post(null, $model, $price, $description, $photo_url, $available, $user_id, $firm_id);
    }


    /**
     * @param $model - string
     * @return string
     */
    public static function editModel($model): string
    {
        if (!isset($model)) return "Undefined";
        $model = str_replace("<", "", $model);
        $model = str_replace(">", "", $model);
        return $model;
    }

    /**
     * @param $price - int
     * @return int
     */
    private static function editPrice($price): int
    {
        if ($price < 0) return 0;
        if ($price > 1000) return 1000;
        return $price;
    }

    /**
     * @param $description - string
     * @return string
     */
    public static function editDescription($description): string
    {
        if (!isset($description)) return "";
        $description = str_replace("<", "", $description);
        $description = str_replace(">", "", $description);
        $description = substr($description, 0, 1000);
        return $description;
    }

}