<?php

$__ROOT__ = dirname(dirname(__FILE__));

require_once($__ROOT__."/../server/Constants.php");
require_once($__ROOT__."/../server/database/services/UserService.php");
require_once($__ROOT__."/../../server/database/services/PostService.php");
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

$post = PostService::getById($post_id);
if (!$post->isLoaded()) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/404");
    exit;
}


$user = UserService::getById($post->user_id);
$to = $user->email;
$subject = "Reservation";
$message = "Dear ". $user->username. ".\n".
           $email." reacted to your offer \"". $post->model ."\"".
           "Please contact him for more details.\n".
           "Email: ".$email."\n";

if ($phone != null) {
    $message .= "Phone: ".$phone."\n";
}
$message .= "Best regards,\n team FILMER\n";
$headers = 'From: noreply <noreply@filmer.com>\r\nX-Mailer: PHP/'.phpversion();
//$headers = "From: noreply <".$user->email.">\r\nX-Mailer: PHP/".phpversion();

$success = mail($to, $subject, $message, $headers);
if ($success == true) {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/offers/reservation/success");
} else {
    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/offers/reservation/fail");
}

exit;