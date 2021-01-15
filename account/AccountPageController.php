<?php

require_once("../server/content/Template.php");
require_once("../server/Constants.php");
require_once("../server/database/services/UserService.php");


$template = new Template("./");
$title = "Account details";

$user_logged = false;
$user_username = null;
if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];

if (!$user_logged) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/auth/signin");
    exit;
}

$user = UserService::getByUsername($user_username);
$user_email = $user->email;
$user_phone = $user->phone;


//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("user_logged", $user_logged);
$template->set("user_username", $user_username);
$template->set("user_email", $user_email);
$template->set("user_phone", $user_phone);
//------------------------------------------------
$template->display("accountPage");