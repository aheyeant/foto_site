<?php

require_once "content/Template.php";
require_once "content/ContentConstants.php";
require_once "database/services/UserService.php";


$template = new Template("content/pages/tpl/account/");
$title = "Account details";
$user_logged = false;
$user_username = null;

if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];

if (!$user_logged) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/signin");
    exit;
}



//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", ContentConstants::$SITE_NAME_UPPERCASE);
$template->set("user_logged", $user_logged);
$template->set("user_username", $user_username);
//------------------------------------------------
$template->display("accountOffersListPage");