<?php

require_once "database/services/UserService.php";
require_once "database/DBConstants.php";
require_once "controllers/helpers/VerifyHelper.php";
require_once "controllers/helpers/UserVerifyHelper.php";
require_once "controllers/helpers/HelpersConstants.php";

$username = null;
$email = null;
$password = null;
$phone = null;
$role = DBConstants::$ROLE_USER;
$verified = true;
$blocked = false;

if (isset($_POST["username"])) $username = $_POST["username"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["password"])) $password = $_POST["password"];
if (isset($_POST["phone"])) $phone = $_POST["phone"];

$_SESSION["signup_verify_error"] = null;
$_SESSION["signup_create_error"] = null;
$_SESSION["signup_verify_old_username"] = null;
$_SESSION["signup_verify_old_email"] = null;
$_SESSION["signup_verify_old_phone"] = null;
$_SESSION["signup_verify_log_username"] = null;
$_SESSION["signup_verify_log_email"] = null;
$_SESSION["signup_verify_log_phone"] = null;
$_SESSION["signup_verify_log_password"] = null;

$verify_result = UserVerifyHelper::createAndVerifyUser($username, $email, $password, $phone, $role, $verified, $blocked);

if ($verify_result["success"])  {
    $user = $verify_result["object"];
    $result = UserService::create($user);
    if ($result["success"]) {
        $user = $result["object"];
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_verified'] = $user->verified;
        $_SESSION['user_blocked'] = $user->blocked;
        header("Location: http://".$_SERVER['HTTP_HOST']);
        exit;
    } else {
        $_SESSION["signup_create_error"] = true;
        header("Location: http://".$_SERVER['HTTP_HOST'].'/signup');
        exit;
    }
} else {
    header("Location: http://".$_SERVER['HTTP_HOST'].'/signup');
    exit;
}