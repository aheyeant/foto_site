<?php


require_once("../../server/Constants.php");
require_once("../../server/database/model/User.php");
require_once("../../server/database/services/UserService.php");
require_once("../../server/helpers/VerifyHelper.php");
require_once("../../server/helpers/UserVerifyHelper.php");


$email = null;
$phone = null;

if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["phone"])) $phone = $_POST["phone"];

$email = VerifyHelper::removeWhitespacesAndTransformToLowerCase($email);
$phone = VerifyHelper::removeWhitespacesAndTransformToLowerCase($phone);


$_SESSION["account_edit_verify_error"] = null;
$_SESSION["account_edit_verify_old_email"] = $email;
$_SESSION["account_edit_verify_old_phone"] = $phone;
$_SESSION["account_edit_verify_log_email"] = null;
$_SESSION["account_edit_verify_log_phone"] = null;

if (!UserVerifyHelper::verifyEmail($email)) {
    $_SESSION["account_edit_verify_error"] = true;
    $_SESSION["account_edit_verify_log_email"] = "Incorrect email format";
}

if (!UserVerifyHelper::verifyPhone($phone)) {
    $_SESSION["account_edit_verify_error"] = true;
    $_SESSION["account_edit_verify_log_phone"] = "Incorrect phone format";
}

if ($_SESSION["account_edit_verify_error"] == true) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX.'/account/edit');
    exit;
}

$user = UserService::getById($_SESSION["user_id"]);

if (UserVerifyHelper::verifyEmailExist($email) and $email != $user->email) {
    $_SESSION["account_edit_verify_error"] = true;
    $_SESSION["account_edit_verify_log_email"] = "Email already exists";
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX.'/account/edit');
    exit;
}


$user->email = $email;
$user->phone = $phone;
UserService::update($user);
header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX.'/account');
