<?php

require_once "database/tdo/UserTDO.php";

$user_login = null;
$user_email = null;
$user_password = null;
$user_phone_number = null;
$user_role = null;


if (isset($_POST["login"]) && $_POST["login"] !== "") $user_login = $_POST["login"];
if (isset($_POST["email"]) && $_POST["email"] !== "") $user_email = $_POST["email"];
if (isset($_POST["password"]) && $_POST["password"] !== "") $user_password = $_POST["password"];
if (isset($_POST["phone_number"]) && $_POST["phone_number"] !== "") $user_phone_number = $_POST["phone_number"];
if (isset($_POST["role"]) && $_POST["role"] !== "") $user_role = $_POST["role"];

//todo control

$user = new UserTDO(null, $user_login, $user_email, $user_password, $user_phone_number, $user_role);
$result = UserTDO::create($user);
