<?php

require_once("../../server/Constants.php");

session_start();

if (isset($_POST[Constants::$POST_ACTION_NAME]) and $_POST[Constants::$POST_ACTION_NAME] == Constants::$POST_SIGN_UP) {
    include "SignUpPostController.php";
    exit;
}

include "SignUpPageController.php";
exit;