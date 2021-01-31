<?php

require_once("../../server/content/Template.php");
require_once("../../server/Constants.php");
require_once("../../server/database/services/FirmService.php");
require_once("../../server/database/services/PostService.php");
require_once("../../server/helpers/VerifyHelper.php");

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

$template = new Template("./");
$title = "Edit Offer";
$firms = FirmService::getAllRows();

//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("user_logged", $user_logged);
$template->set("user_username", $user_username);
$template->set("firms", $firms);
$template->set("post", $post);
//------------------------------------------------
$template->display("editPage");