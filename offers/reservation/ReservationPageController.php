<?php

require_once("../../server/content/Template.php");
require_once("../../server/Constants.php");
require_once("../../server/database/services/PostService.php");
require_once("../../server/database/services/UserService.php");



$user_logged = false;
$user_username = null;
if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];
if ($user_logged == false) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/auth/signin");
    exit;
}

$template = new Template("./");
$title = "New Reservation";

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

$user = UserService::getById($_SESSION["user_id"]);

if (!$user->isLoaded()) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/404");
    exit;
}

$user_email = "";
$user_phone = "";
if ($user->email != null) $user_email = $user->email;
if ($user->phone != null) $user_phone = $user->phone;

$verify_error = false;
$fatal_error = false;
$user_old_email = "";
$user_old_phone = "";
$user_log_email = "";
$user_log_phone = "";

if (isset($_SESSION["reservation_verify_error"])) $verify_error = $_SESSION["reservation_verify_error"];
if (isset($_SESSION["reservation_create_error"])) $fatal_error = $_SESSION["reservation_create_error"];
if (isset($_SESSION["reservation_verify_old_email"])) $user_old_email = $_SESSION["reservation_verify_old_email"];
if (isset($_SESSION["reservation_verify_old_phone"])) $user_old_phone = $_SESSION["reservation_verify_old_phone"];
if (isset($_SESSION["reservation_verify_log_email"])) $user_log_email = $_SESSION["reservation_verify_log_email"];
if (isset($_SESSION["reservation_verify_log_phone"])) $user_log_phone = $_SESSION["reservation_verify_log_phone"];

print $verify_error;
print $fatal_error;
print $user_old_email;
print $user_old_phone;
print $user_log_email;
print $user_log_phone;

$_SESSION["reservation_verify_error"] = null;
$_SESSION["reservation_create_error"] = null;
$_SESSION["reservation_verify_old_email"] = null;
$_SESSION["reservation_verify_old_phone"] = null;
$_SESSION["reservation_verify_log_email"] = null;
$_SESSION["reservation_verify_log_phone"] = null;

$post = PostService::fetchPostsArray([$post])[0];


//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("user_logged", $user_logged);
$template->set("user_username", $user_username);
$template->set("post_id", $post->id);
$template->set("user_email", $user_email);
$template->set("user_phone", $user_phone);
$template->set("verify_error", $verify_error);
$template->set("fatal_error", $fatal_error);
$template->set("old_email", $user_old_email);
$template->set("old_phone", $user_old_phone);
$template->set("log_email", $user_log_email);
$template->set("log_phone", $user_log_phone);
//------------------------------------------------
$template->display("reservationPage");