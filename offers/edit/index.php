<?php

require_once("../../server/Constants.php");

session_start();

if (isset($_POST[Constants::$POST_ACTION_NAME]) and $_POST[Constants::$POST_ACTION_NAME] == Constants::$POST_EDIT_OFFER) {
    include "EditPostController.php";
    exit;
}

include "EditPageController.php";
exit;