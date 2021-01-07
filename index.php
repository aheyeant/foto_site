<?php
    session_start();

    if (isset($_POST[RouterConstants::$POST_ACTION_NAME])) {
        include "routers/postRouter.php";
        exit;
    }

    include "content/controllers/auth/signUpPageController.php";
