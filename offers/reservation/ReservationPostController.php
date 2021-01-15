<?php

$__ROOT__ = dirname(dirname(__FILE__));

require_once($__ROOT__."/../server/Constants.php");
require_once($__ROOT__."/../server/database/services/UserService.php");
require_once($__ROOT__."/../helpers/VerifyHelper.php");
require_once($__ROOT__."/../helpers/UserVerifyHelper.php");


$post_id = null;
$email = null;
$phone = null;

if (isset($_POST["post_id"])) $post_id = $_POST["post_id"];
if (isset($_POST["email"])) $email = $_POST["email"];
if (isset($_POST["phone"])) $phone = $_POST["phone"];

$email = VerifyHelper::removeWhitespacesAndTransformToLowerCase($email);
$phone = VerifyHelper::removeWhitespacesAndTransformToLowerCase($phone);

$_SESSION["reservation_verify_error"] = false;
$_SESSION["reservation_create_error"] = false;
$_SESSION["reservation_verify_old_email"] = $email;
$_SESSION["reservation_verify_old_phone"] = $phone;
$_SESSION["reservation_verify_log_email"] = null;
$_SESSION["reservation_verify_log_phone"] = null;

if (!UserVerifyHelper::verifyEmail($email)) {
    $_SESSION["reservation_verify_error"] = true;
    $_SESSION["reservation_verify_log_email"] = "Incorrect email format";
}
if (!UserVerifyHelper::verifyPhone($phone)) {
    $_SESSION["reservation_verify_error"] = true;
    $_SESSION["reservation_verify_log_phone"] = "Incorrect phone format";
}

if ($_SESSION["reservation_verify_error"] == true) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/offers/reservation?id=".$post_id);
    exit;
}

//TODO implement send email
/*if (!sendEmail()) {
    $_SESSION["reservation_create_error"] = true;
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/offers/reservation?id=".$post_id);
    exit;
}*/

header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/offers/reservation/success");
exit;