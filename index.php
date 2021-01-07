<?php
    session_start();

    if (isset($_POST["action"])) {
        include "database/postControllers/loginPagePostController.php";
        exit;
    }

    include "content/controllers/loginPageController.php";
