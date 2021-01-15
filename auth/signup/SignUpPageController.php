<?php

require_once "../../server/content/Template.php";
require_once "../../server/Constants.php";


$user_logged = false;
if (isset($_SESSION["user_id"])) $user_logged = true;
if ($user_logged) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/home");
}

$template = new Template("./");
$title = "Sign Up";

$verify_error = false;
$create_error = false;
$old_username = null;
$old_email = null;
$old_phone = null;
$log_username = "";
$log_email = "";
$log_phone = "";
$log_password = "";

if (isset($_SESSION["signup_verify_error"])) $verify_error = $_SESSION["signup_verify_error"];
if (isset($_SESSION["signup_create_error"])) $create_error = $_SESSION["signup_create_error"];
if (isset($_SESSION["signup_verify_old_username"])) $old_username = $_SESSION["signup_verify_old_username"];
if (isset($_SESSION["signup_verify_old_email"])) $old_email = $_SESSION["signup_verify_old_email"];
if (isset($_SESSION["signup_verify_old_phone"])) $old_phone = $_SESSION["signup_verify_old_phone"];
if (isset($_SESSION["signup_verify_log_username"])) $log_username = $_SESSION["signup_verify_log_username"];
if (isset($_SESSION["signup_verify_log_email"])) $log_email = $_SESSION["signup_verify_log_email"];
if (isset($_SESSION["signup_verify_log_phone"])) $log_phone = $_SESSION["signup_verify_log_phone"];
if (isset($_SESSION["signup_verify_log_password"])) $log_password = $_SESSION["signup_verify_log_password"];

$_SESSION["signup_verify_error"] = null;
$_SESSION["signup_create_error"] = null;
$_SESSION["signup_verify_old_username"] = null;
$_SESSION["signup_verify_old_email"] = null;
$_SESSION["signup_verify_old_phone"] = null;
$_SESSION["signup_verify_log_username"] = null;
$_SESSION["signup_verify_log_email"] = null;
$_SESSION["signup_verify_log_phone"] = null;
$_SESSION["signup_verify_log_password"] = null;


//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("verify_error", $verify_error);
$template->set("create_error", $create_error);
$template->set("old_username", $old_username);
$template->set("old_email", $old_email);
$template->set("old_phone", $old_phone);
$template->set("log_username", $log_username);
$template->set("log_email", $log_email);
$template->set("log_phone", $log_phone);
$template->set("log_password", $log_password);
//------------------------------------------------
$template->display("signupPage");
