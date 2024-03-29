<?php

require_once dirname(__DIR__) . "/loadEnv.php";
require_once dirname(__DIR__, 2) . "/models/UserModel.php";

$name = $_POST['name'] ?? null;
$firstName = $_POST['firstName'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordConfirm = $_POST['passwordConfirm'] ?? null;

if (!$name || !$firstName || !$email || !$password || !$passwordConfirm) {
    header("Location: ../../register?error=true");
    return;
}

if ($password !== $passwordConfirm) {
    header("Location: ../../register?error=true");
    return;
}

try {
    $user = createUser($email, $password, $firstName, $name);
} catch (Exception $e) {
    header("Location: ../../register?error=true");
    return;
}

session_start();
$_SESSION["user_id"] = $user['id'];
$_SESSION["user_name"] = $user['name'];
$_SESSION["user_surname"] = $user['surname'];
$_SESSION["user_email"] = $user['email'];

header("Location: ./../../");

