<?php

require_once("../../server/Constants.php");
require_once("../../server/database/services/PostService.php");
require_once("../../server/helpers/PostVerifyHelper.php");


$user_logged = false;
$user_username = null;
if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];
if (!$user_logged) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/auth/signin");
}


$id = null;
$firm = null;
$model = null;
$price = null;
$description = null;

if (isset($_POST["id"])) $id = $_POST["id"];
if (isset($_POST["firm"])) $firm = $_POST["firm"];
if (isset($_POST["model"])) $model = $_POST["model"];
if (isset($_POST["price"])) $price = $_POST["price"];
if (isset($_POST["description"])) $description = $_POST["description"];

$post = PostService::getById($id);
if (!$post->isLoaded()) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/404");
}
if ($post->user_id != $_SESSION["user_id"]) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/");
}

$post->firm_id = $firm;
$post->model = PostVerifyHelper::editModel($model);
$post->price = $price;
$post->description = PostVerifyHelper::editDescription($description);

PostService::update($post);

header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX.'/offers?id='.$post->id);