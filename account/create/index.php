<?php

require_once("../../server/Constants.php");

session_start();

if (isset($_POST[Constants::$POST_ACTION_NAME]) and $_POST[Constants::$POST_ACTION_NAME] == Constants::$POST_CREATE_OFFER) {
    include "CreatePostController.php";
    exit;
}

include "CreatePageController.php";
exit;