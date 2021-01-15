<?php

    require_once "server/Constants.php";

    header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/home");
    exit;