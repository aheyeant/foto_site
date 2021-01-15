<?php

require_once("../../server/Constants.php");
require_once("../../server/database/services/PostService.php");
require_once("../../server/helpers/PostVerifyHelper.php");

$_ROOT_ = dirname(dirname(__FILE__));
$upload_path = $_ROOT_."/..".Constants::$DEPLOY_PREFIX.Constants::$IMAGES_ASSETS_PATH;
$firm = null;
$model = null;
$price = null;
$description = null;
$image = Constants::$DEPLOY_PREFIX.Constants::$IMAGES_ASSETS_PATH.Constants::$DEFAULT_IMAGE_NAME;

if (isset($_POST["firm"])) $firm = $_POST["firm"];
if (isset($_POST["model"])) $model = $_POST["model"];
if (isset($_POST["price"])) $price = $_POST["price"];
if (isset($_POST["description"])) $description = $_POST["description"];


if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
    $type = explode("/", $_FILES["image"]["type"])[1];
    if ($type == "png" or $type == "jpg" or $type == "jpeg") {
        $tmp_name = $_FILES["image"]["tmp_name"];
        $file_name = time() . $_SESSION["user_id"] . "." . $type;
        $file_path = $upload_path . $file_name;
        move_uploaded_file($tmp_name, $file_path);
        $image = Constants::$DEPLOY_PREFIX.Constants::$IMAGES_ASSETS_PATH.$file_name;
    }
}

$post = PostVerifyHelper::createAndVerifyPost($model, $price, $description, $image, 1, $_SESSION["user_id"], $firm);
PostService::create($post);


header("Location: http://".$_SERVER['HTTP_HOST'].Constants::$DEPLOY_PREFIX.'/account');