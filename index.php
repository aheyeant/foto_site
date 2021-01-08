<?php
    require_once "routers/RouterConstants.php";

    session_start();

    if (isset($_POST[RouterConstants::$POST_ACTION_NAME])) {
        include "routers/PostRouter.php";
        exit;
    }

    if (isset($_GET[RouterConstants::$GET_ACTION_NAME])) {
        include "routers/GetRouter.php";
        exit;
    }

    include "routers/PathRouter.php";
