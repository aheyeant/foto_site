<?php


require_once "database/services/PostService.php";
require_once "controllers/helpers/PostVerifyHelper.php";

$upload_path = "assets/";
$firm = null;
$model = null;
$price = null;
$description = null;
$image = "/assets/camera.png";

if (isset($_POST["firm"])) $firm = $_POST["firm"];
if (isset($_POST["model"])) $model = $_POST["model"];
if (isset($_POST["price"])) $price = $_POST["price"];
if (isset($_POST["description"])) $description = $_POST["description"];


if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
    $type = explode("/", $_FILES["image"]["type"])[1];
    if ($type == "png" or $type == "jpg" or $type == "jpeg") {
        $tmp_name = $_FILES["image"]["tmp_name"];
        $file_name = $upload_path . time() . $_SESSION["user_id"] . "." . $type;
        move_uploaded_file($tmp_name, $file_name);
        $image = $file_name;
    }
}

$post = PostVerifyHelper::createAndVerifyPost($model, $price, $description, $image, 1, $_SESSION["user_id"], $firm);
PostService::create($post);


header("Location: http://".$_SERVER['HTTP_HOST'].'/account');