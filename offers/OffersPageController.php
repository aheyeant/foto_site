<?php

require_once("../server/content/Template.php");
require_once("../server/Constants.php");
require_once("../server/database/services/PostService.php");


$template = new Template("./");
$title = "Offer details";

$user_logged = false;
$user_username = null;
if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];

$id = null;
if (isset($_GET["id"])) $id = intval($_GET["id"]);
if ($id == null) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/404");
    exit;
}

$post = PostService::getById($id);

if (!$post->isLoaded()) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/404");
    exit;
}
$post = PostService::fetchPostsArray([$post])[0];
$user_owned = false;
if ($user_logged and $_SESSION["user_id"] == $post->user_id) $user_owned = true;


//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("user_logged", $user_logged);
$template->set("user_username", $user_username);
$template->set("user_owned", $user_owned);
$template->set("post", $post);
//------------------------------------------------
$template->display("offersPage");