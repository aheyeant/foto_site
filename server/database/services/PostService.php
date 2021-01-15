<?php

$__ROOT__ = dirname(dirname(__FILE__));

require_once("IService.php");
require_once($__ROOT__."/core.php");
require_once($__ROOT__."/model/Post.php");
require_once($__ROOT__."/services/UserService.php");
require_once($__ROOT__."/services/FirmService.php");
require_once($__ROOT__."/../Constants.php");


class PostService implements IService {

    /**
     * @param $id
     * @return Post
     */
    public static function getById($id): Post
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM posts WHERE id = :id";
        $response = $db->getRow($query, ['id' => $id]);
        $db->close();
        if ($response == null) return Post::initEmptyPost();
        return Post::initPostFromDBResponse($response);
    }

    /**
     * @return array
     */
    public static function getAllRows(): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM posts";
        $response = $db->getMultiplyRows($query, null);
        $db->close();
        if ($response == null) return [];
        $content = [];
        foreach ($response as $item) {
            $content[] = Post::initPostFromDBResponse($item);
        }
        return $content;
    }

    /**
     * @param $page: int
     * @return array = ["error": false|true,
     *                  "page": int|null,
     *                  "prev": int|null
     *                  "next": int|null
     *                  "items": array Post|null]
     */
    public static function getAllByPage($page): array
    {
        if (!isset($page) || !is_int($page) || $page < 1) {
            return ["error" => true, "page" => null, "prev" => null, "next" => null, "items" => null];
        }
        $all = self::getAllRows();
        if (count($all) == 0) {
            return ["error" => false, "page" => 1, "prev" => null, "next" => null, "items" => []];
        }
        if (count($all) - $page * Constants::$ITEMS_PER_PAGE <= -Constants::$ITEMS_PER_PAGE) {
            return ["error" => true, "page" => null, "prev" => null, "next" => null, "items" => null];
        }
        $ret = [];
        for ($i = ($page - 1) * Constants::$ITEMS_PER_PAGE; $i < ($page) * Constants::$ITEMS_PER_PAGE; $i++) {
            if (count($all) == $i) break;
            $ret[] = $all[$i];
        }
        $prev = "page=".($page - 1);
        $next = "page=".($page + 1);
        if ($page - 1 == 0) $prev = null;
        if (count($all) - $page * Constants::$ITEMS_PER_PAGE <= 0) $next = null;
        return ["error" => false, "page" => $page, "prev" => $prev, "next" => $next, "items" => $ret];
    }

    /**
     * @param $user_id: int
     * @param $page : int
     * @return array = ["error": false|true,
     *                  "page": int|null,
     *                  "prev": int|null
     *                  "next": int|null
     *                  "items": array Post|null]
     */
    public static function getByUserIdByPage($user_id, $page): array
    {
        if (!isset($page) || !is_int($page) || $page < 1) {
            return ["error" => true, "page" => null, "prev" => null, "next" => null, "items" => null];
        }
        $all = self::getAllByUserId($user_id);
        if (count($all) == 0) {
            return ["error" => false, "page" => 1, "prev" => null, "next" => null, "items" => []];
        }
        if (count($all) - $page * Constants::$ITEMS_PER_PAGE <= -Constants::$ITEMS_PER_PAGE) {
            return ["error" => true, "page" => null, "prev" => null, "next" => null, "items" => null];
        }
        $ret = [];
        for ($i = ($page - 1) * Constants::$ITEMS_PER_PAGE; $i < ($page) * Constants::$ITEMS_PER_PAGE; $i++) {
            if (count($all) == $i) break;
            $ret[] = $all[$i];
        }
        $prev = "page=".($page - 1);
        $next = "page=".($page + 1);
        if ($page - 1 == 0) $prev = null;
        if (count($all) - $page * Constants::$ITEMS_PER_PAGE <= 0) $next = null;
        return ["error" => false, "page" => $page, "prev" => $prev, "next" => $next, "items" => $ret];
    }

    /**
     * Load $user_username and $firm_name
     *
     * @param $posts - array Post
     * @return array
     */
    public static function fetchPostsArray($posts): array
    {
        foreach ($posts as $post) {
            $user = UserService::getById($post->user_id);
            $firm = FirmService::getById($post->firm_id);
            $post->user_username = strlen($user->username) > 12 ? substr($user->username, 0, 12) . "..." : $user->username;
            $post->firm_name = $firm->name;
        }
        return $posts;
    }

    /**
     * @return array
     */
    public static function getAllAvailable(): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM posts WHERE available = 1";
        $response = $db->getMultiplyRows($query, null);
        $db->close();
        if ($response == null) return [];
        $content = [];
        foreach ($response as $item) {
            $content[] = Post::initPostFromDBResponse($item);
        }
        return $content;
    }

    /**
     * @return array
     */
    public static function getAllNotAvailable(): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM posts WHERE available = 0";
        $response = $db->getMultiplyRows($query, null);
        $db->close();
        if ($response == null) return [];
        $content = [];
        foreach ($response as $item) {
            $content[] = Post::initPostFromDBResponse($item);
        }
        return $content;
    }

    /**
     * @param $userId - user id
     * @return array
     */
    public static function getAllByUserId($userId): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM posts WHERE user_id = :id";
        $response = $db->getMultiplyRows($query, ["id" => $userId]);
        $db->close();
        if ($response == null) return [];
        $content = [];
        foreach ($response as $item) {
            $content[] = Post::initPostFromDBResponse($item);
        }
        return $content;
    }

    /**
     * @param $firmId - user id
     * @return array
     */
    public static function getAllByFirmId($firmId): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "SELECT * FROM posts WHERE firm_id = :id";
        $response = $db->getMultiplyRows($query, ["id" => $firmId]);
        $db->close();
        if ($response == null) return [];
        $content = [];
        foreach ($response as $item) {
            $content[] = Post::initPostFromDBResponse($item);
        }
        return $content;
    }

    /**
     * @param $item - Post
     */
    public static function update($item)
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "UPDATE posts SET model = :model, price = :price, description = :description, photo_url = :photo_url, available = :available, user_id = :user_id, firm_id = :firm_id WHERE id = :id";
        $db->update($query, ['id' => $item->id,
                             'model' => $item->model,
                             'price' => $item->price,
                             'description' => $item->description,
                             'photo_url' => $item->photo_url,
                             'available' => $item->available,
                             'user_id' => $item->user_id,
                             'firm_id' => $item->firm_id]);
        $db->close();
    }

    /**
     * Create new post
     *
     * don't check if $item is valid, must be checked until
     * can't return created object
     *
     * @param $item
     * @return array
     */
    public static function create($item): array
    {
        $db = new MySQLDatabase();
        $db->connect();
        $query = "INSERT INTO posts (model, price, description, photo_url, available, user_id, firm_id) VALUES (:model, :price, :description, :photo_url, :available, :user_id, :firm_id)";
        $result = $db->add($query, ['model' => $item->model,
                                    'price' => $item->price,
                                    'description' => $item->description,
                                    'photo_url' => $item->photo_url,
                                    'available' => $item->available,
                                    'user_id' => $item->user_id,
                                    'firm_id' => $item->firm_id]);
        $db->close();
        if ($result["success"]) {
            $result["object"] = "SUCCESS";
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