<?php

switch ($_POST[RouterConstants::$POST_ACTION_NAME]) {
    case RouterConstants::$POST_SIGN_UP:
        include "controllers/postControllers/signUpPostController.php"; break;

    default:
        break;
}