<?php

switch ($_POST[RouterConstants::$POST_ACTION_NAME]) {
    case RouterConstants::$POST_SIGN_UP:
        include "controllers/postControllers/signUpPostController.php"; break;
    case RouterConstants::$POST_SIGN_IN:
        include "controllers/postControllers/signInPostController.php"; break;
    case RouterConstants::$POST_ACCOUNT_EDIT:
        include "controllers/postControllers/accountEditPostController.php"; break;
    case RouterConstants::$POST_ACCOUNT_RESET_PASSWORD:
        include "controllers/postControllers/accountResetPasswordPostController.php"; break;
    case RouterConstants::$POST_CREATE_OFFER:
        include "controllers/postControllers/offerCreatePostController.php"; break;
    default:
        include "content/controllers/404PageController.php";
        break;
}