<?php
if ($_POST) {
    //strip_tags , intval filtering
    $name = MainHelper::postVariable("name");
    $surname = MainHelper::postVariable("surname");
    $email = MainHelper::postVariable("email");
    $gender = MainHelper::postIntVariable("gender"); // 0 erkek, 1 kadın
    $password = MainHelper::postVariable("password");
    if ($name != "" and $surname != "" and $email != "" and $password != "") {
        //...
    } else {
        $returnArray['status'] = false;
        $returnArray['message'] = "Lütfen tüm alanları doldurunuz!";
    }
} else {
    die("Post işlemi yapılmamış");
}
