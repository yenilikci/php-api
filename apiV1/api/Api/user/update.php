<?php
if ($_POST) {
    //strip_tags , intval filtering
    $id = MainHelper::postVariable("id");
    $name = MainHelper::postVariable("name");
    $surname = MainHelper::postVariable("surname");
    $email = MainHelper::postVariable("email");
    $password = MainHelper::postVariable("password");
    $gender = MainHelper::postIntVariable("gender");

    //field check
    if ($name == "" or $surname == "" or $email == "" or $password == "") {
        $returnArray['message'] = "Lütfen tüm alanları doldurunuz!";
        return;
    }

    //record check - user
    $c = $db->db->prepare("select * from users where id=?");
    $c->execute(array(
        $id
    ));
    $count = $c->rowCount();
    if ($count == 0) {
        $returnArray['message'] = "Böyle bir kullanıcı yok";
        return;
    }

    //email using check
    $cEmail = $db->db->prepare("select * from users where id!=? and email=?");
    $cEmail->execute(array(
        $id,
        $email
    ));
    $countEmail = $cEmail->rowCount();
    if ($countEmail != 0) {
        $returnArray['message'] = "Bu email kullanımda";
    }

    $w = $db->db->prepare("select * from users where id=?");
    $w->execute(array(
        $id
    ));
    $result = $w->fetch(PDO::FETCH_ASSOC);
    //password required check
    if ($password == "") {
        $password = $result['password'];
    }

    //update
    $updateQuery = $db->db->prepare("update users set name=?, surname=?, email=? , password =? , gender=? where id=?");
    $result = $updateQuery->execute(array(
        $name,
        $surname,
        $email,
        $password,
        $gender,
        $id
    ));
    if ($result) {
        $returnArray['status'] = true;
        $returnArray['message'] = "Bilgiler başarılı bir şekilde güncellendi!";
    } else {
        $returnArray['message'] = "Güncelleme işlemi başarısız!";
    }
}
