<?php

require_once("../../server/Constants.php");

session_start();

if (isset($_POST[Constants::$POST_ACTION_NAME]) and $_POST[Constants::$POST_ACTION_NAME] == Constants::$POST_ACCOUNT_RESET_PASSWORD) {
    include "PasswordPostController.php";
    exit;
}

include "PasswordPageController.php";
exit;