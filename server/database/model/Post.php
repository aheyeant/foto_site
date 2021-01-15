<?php

class Post {

    public $id;
    public $model;
    public $price;
    public $description;
    public $photo_url;
    public $available;
    public $user_id;
    public $firm_id;
    public $is_loaded = false;

    /**
     * Post constructor.
     * @param $id
     * @param $model
     * @param $price
     * @param $description
     * @param $photo_url
     * @param $available
     * @param $user_id
     * @param $firm_id
     */
    public function __construct($id, $model, $price, $description, $photo_url, $available, $user_id, $firm_id)
    {
        $this->id = $id;
        $this->model = $model;
        $this->price = $price;
        $this->description = $description;
        $this->photo_url = $photo_url;
        $this->available = $available;
        $this->user_id = $user_id;
        $this->firm_id = $firm_id;
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
     * @return Post
     */
    public static function initPostFromDBResponse($response): Post
    {
        $id = null;
        $model = null;
        $price = null;
        $description = null;
        $photo_url = null;
        $available = null;
        $user_id = null;
        $firm_id = null;

        if (isset($response["id"])) $id = $response["id"];
        if (isset($response["model"])) $model = $response["model"];
        if (isset($response["price"])) $price = $response["price"];
        if (isset($response["description"])) $description = $response["description"];
        if (isset($response["photo_url"])) $photo_url = $response["photo_url"];
        if (isset($response["available"])) $available = $response["available"];
        if (isset($response["user_id"])) $user_id = $response["user_id"];
        if (isset($response["firm_id"])) $firm_id = $response["firm_id"];

        if (!isset($id) or !isset($model) or !isset($price) or !isset($available) or !isset($user_id) or !isset($firm_id)) {
            return self::initEmptyPost();
        }
        return new Post($id, $model, $price, $description, $photo_url, $available, $user_id, $firm_id);
    }

    /**
     * @return Post
     */
    public static function initEmptyPost(): Post
    {
        return new Post(null, null, null, null, null, null, null, null);
    }
}