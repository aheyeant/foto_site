<?php

require_once "content/Template.php";

//require_once "Content/Controllers/auth.php";

$template = new Template("content/pages/tpl/auth/");
$title = "Sign Up";

$template->set("title", $title);

//------------------------------------------------
$template->display("signUpPage");
