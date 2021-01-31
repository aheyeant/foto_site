<?php

require_once("../../server/content/Template.php");
require_once("../../server/Constants.php");
require_once("../../server/database/services/PostService.php");


$user_logged = false;
$user_username = null;
if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];
if (!$user_logged) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/auth/signin");
    exit;
}

$template = new Template("./");
$title = "My offers";

$page = 1;
if (isset($_GET["page"])) $page = intval($_GET["page"]);

$res = PostService::getByUserIdByPage($_SESSION["user_id"], $page);

$post_items_error = $res["error"];

if ($post_items_error) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX.'/404');
}
$post_items = $res["items"];
$post_items = PostService::fetchPostsArray($post_items);
$post_items_page = $res["page"];
$post_items_prev = null;
if ($res["prev"] != null) {
    $post_items_prev = "/account/offers?".$res["prev"];
}
$post_items_next = null;
if ($res["next"] != null) {
    $post_items_next = "/account/offers?".$res["next"];
}
//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("user_logged", $user_logged);
$template->set("user_username", $user_username);
$template->set("post_items_error", $post_items_error);
$template->set("post_items", $post_items);
$template->set("post_items_page", $post_items_page);
$template->set("post_items_prev", $post_items_prev);
$template->set("post_items_next", $post_items_next);
//------------------------------------------------
$template->display("offersPage");