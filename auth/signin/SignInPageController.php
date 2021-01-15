<?php

require_once("../../server/content/Template.php");
require_once("../../server/Constants.php");

// --- User privileges ---
$user_logged = false;
if (isset($_SESSION["user_id"])) $user_logged = true;
if ($user_logged) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/home");
}

$template = new Template("./");
$title = "Sign In";

$verify_error = false;
$signin_error = false;
$log_username = null;
$old_username = null;
$log_password = null;

if (isset($_SESSION["signin_verify_error"])) $verify_error = true;
if (isset($_SESSION["signin_error"])) $signin_error = true;
if (isset($_SESSION["signin_verify_old_username"])) $old_username = $_SESSION["signin_verify_old_username"];
if (isset($_SESSION["signin_verify_log_username"])) $log_username = $_SESSION["signin_verify_log_username"];
if (isset($_SESSION["signin_verify_log_password"])) $log_password = $_SESSION["signin_verify_log_password"];

$_SESSION["signin_verify_error"] = null;
$_SESSION["signin_error"] = null;
$_SESSION["signin_verify_old_username"] = null;
$_SESSION["signin_verify_log_username"] = null;
$_SESSION["signin_verify_log_password"] = null;


//------------------------------------------------
$template->set("title", $title);
$template->set("site_name", Constants::$SITE_NAME_UPPERCASE);
$template->set("deploy_prefix", Constants::$DEPLOY_PREFIX);
$template->set("verify_error", $verify_error);
$template->set("old_username", $old_username);
$template->set("log_username", $log_username);
$template->set("log_password", $log_password);
$template->set("signin_error", $signin_error);
//------------------------------------------------
$template->display("signinPage");