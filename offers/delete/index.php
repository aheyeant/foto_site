<?php

require_once("../../server/Constants.php");
require_once("../../server/database/services/PostService.php");

session_start();

$user_logged = false;
$user_username = null;
if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];
if (!$user_logged) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/auth/signin");
}

if (!isset($_GET["id"])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/404");
}

$post = PostService::getById($_GET["id"]);
if (!$post->isLoaded()) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/404");
}
if ($post->user_id != $_SESSION["user_id"]) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/");
}

PostService::delete($post->id);

header("Location: http://" . $_SERVER['HTTP_HOST'] . Constants::$DEPLOY_PREFIX . "/account/offers");