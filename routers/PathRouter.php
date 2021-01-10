<?php

$path = $_SERVER["REQUEST_URI"];


if ($path == "/") {
    include "content/controllers/mainPageController.php";
    exit;
}

if ($path[-1] == "/") {
    include "content/controllers/404PageController.php";

    // TODO REMOVE
    print "TY LOX; need implement 404controller";
    exit;
}

$p_array = explode("/", $path . "/////////");



// ------------------ REMOVE -----------------------

/*print count($p_array);

for ($i = 0; $i < count($p_array); $i++) {
    print $p_array[$i] . " " . $i;
    print "<br/>";
}

print $path;*/

// ------------------ REMOVE -----------------------

switch ($path) {
    case "/signin":
        include "content/controllers/auth/signInPageController.php"; break;
    case "/signup":
        include "content/controllers/auth/signUpPageController.php"; break;
    case "/signout":
        include "content/controllers/auth/signOutPageController.php"; break;
    case "/account":
        include "content/controllers/account/accountDetailsController.php"; break;
    case "/account/edit":
        include "content/controllers/account/accountEditController.php"; break;
    case "/account/offers":
        include "content/controllers/account/accountOffersListController.php"; break;
    case "/offers/create":
        include "content/controllers/offers/offerCreateController.php"; break;
    case "/password/change":
        include "content/controllers/account/accountResetPasswordController.php"; break;

    default:
        include "content/controllers/404PageController.php";
}
exit;