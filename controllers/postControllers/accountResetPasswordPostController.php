<?php


require_once "database/model/User.php";
require_once "database/services/UserService.php";
require_once "database/DBConstants.php";
require_once "controllers/helpers/VerifyHelper.php";
require_once "controllers/helpers/UserVerifyHelper.php";

$old_password = null;
$new_password = null;

if (isset($_POST["old_password"])) $old_password = $_POST["old_password"];
if (isset($_POST["new_password"])) $new_password = $_POST["new_password"];

$old_password = VerifyHelper::removeWhitespacesAndTransformToLowerCase($old_password);
$new_password = VerifyHelper::removeWhitespacesAndTransformToLowerCase($new_password);


$_SESSION["reset_password_verify_error"] = null;
$_SESSION["reset_password_verify_log_old_password"] = null;
$_SESSION["reset_password_verify_log_new_password"] = null;



if (!UserVerifyHelper::verifyPassword($old_password)) {
    $_SESSION["reset_password_verify_error"] = true;
    $_SESSION["reset_password_verify_log_old_password"] = "Password must be at least " . HelpersConstants::$PASSWORD_MIN_LENGTH . " characters";
}

if (!UserVerifyHelper::verifyPassword($new_password)) {
    $_SESSION["reset_password_verify_error"] = true;
    $_SESSION["reset_password_verify_log_new_password"] = "Password must be at least " . HelpersConstants::$PASSWORD_MIN_LENGTH . " characters";
}

if ($_SESSION["reset_password_verify_error"] == true) {
    header("Location: http://".$_SERVER['HTTP_HOST'].'/password/change');
    exit;
}

$user = UserService::getById($_SESSION["user_id"]);

if (!password_verify($old_password, $user->password)) {
    $_SESSION["reset_password_verify_error"] = true;
    $_SESSION["reset_password_verify_log_old_password"] = "Wrong password";
    header("Location: http://".$_SERVER['HTTP_HOST'].'/password/change');
    exit;
} else {
    $encryptedPassword = password_hash($new_password, PASSWORD_DEFAULT);
    $user->password = $encryptedPassword;
    UserService::update($user);
}
header("Location: http://".$_SERVER['HTTP_HOST'].'/account');