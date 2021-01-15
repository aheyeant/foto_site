<?php

require_once("../../server/content/Template.php");
require_once("../../server/Constants.php");
require_once("../../server/database/services/UserService.php");


$user_logged = false;
$user_username = null;
if (isset($_SESSION["user_id"])) $user_logged = true;
if (isset($_SESSION["user_username"])) $user_username = strlen($_SESSION["user_username"]) > 12 ? substr($_SESSION["user_username"], 0, 12) . "..." : $_SESSION["user_username"];
if (!$user_logged) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/auth/signin");
    exit;
}

$template = new Template("./");
$title = "Edit account";

$user = UserService::getByUsername($user_username);

$user_email = $user->email;
$user_phone = $user->phone;
if ($user_phone == null) $user_phone = "";

$verify_error = false;
$old_email = null;
$old_phone = null;
$log_email = "";
$log_phone = "";

if (isset($_SESSION["account_edit_verify_error"])) $verify_error = $_SESSION["account_edit_verify_error"];
if (isset($_SESSION["account_edit_verify_old_email"])) $old_email = $_SESSION["account_edit_verify_old_email"];
if (isset($_SESSION["account_edit_verify_old_phone"])) $old_phone = $_SESSION["account_edit_verify_old_phone"];
if (isset($_SESSION["account_edit_verify_log_email"])) $log_email = $_SESSION["account_edit_verify_log_email"];
if (isset($_SESSION["account_edit_verify_log_phone"])) $log_phone = $_SESSION["account_edit_verify_log_phone"];

$_SESSION["account_edit_verify_error"] = null;
$_SESSION["account_edit_verify_old_email"] = null;
$_SESSION["account_edit_verify_old_phone"] = null;
$_SESSION["account_edit_verify_log_email"] = null;
$_SESSION["account_edit_verify_log_phone"] = null;


//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("user_logged", $user_logged);
$template->set("user_username", $user_username);
$template->set("verify_error", $verify_error);
$template->set("old_email", $old_email);
$template->set("old_phone", $old_phone);
$template->set("log_email", $log_email);
$template->set("log_phone", $log_phone);
$template->set("user_email", $user_email);
$template->set("user_phone", $user_phone);

//------------------------------------------------
$template->display("editPage");
