<?php

require_once "content/Template.php";

//require_once "Content/Controllers/auth.php";

$template = new Template("content/pages/tpl/auth/");
$title = "Sign In";

$template->set("title", $title);

//------------------------------------------------
$template->display("signInPage");