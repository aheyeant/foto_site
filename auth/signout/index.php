<?php

require_once("../../server/Constants.php");
session_start();
session_destroy();

header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX."/home");
exit;