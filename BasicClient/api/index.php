<?php
session_start();
if ($_POST) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $_SESSION["email"] = $email;
    $_SESSION["password"] = md5($password);
}
