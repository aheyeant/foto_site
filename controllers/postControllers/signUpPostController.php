<?php

require_once "database/services/UserService.php";
require_once "database/DBConstants.php";
require_once "controllers/helpers/VerifyHelper.php";
require_once "controllers/helpers/UserVerifyHelper.php";

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

$verify_result = UserVerifyHelper::createAndVerifyUser($username, $email, $password, $phone, $role, $verified, $blocked);

if ($verify_result["success"]) {
    $user = $verify_result["object"];
    $result = UserService::create($user);
    if ($result["success"]) {
        $user = $result["object"];
        //todo
    } else {
        $log = $result["object"];
        //todo
    }
} else {
    //todo
}
