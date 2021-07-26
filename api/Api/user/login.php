<?php
if ($_POST) {
    $email = MainHelper::postVariable("email");
    $password = MainHelper::postVariable("password");

    //field check
    if ($email == "" or $password == "") {
        $returnArray['message'] = "Lütfen tüm alanları doldurunuz";
        return;
    }
    //record check
    $c = $db->db->prepare("select * from users where email=?");
    $c->execute(array(
        $email
    ));
    $count = $c->rowCount();
    if ($count == 0) {
        $returnArray['message'] = "Email sistemde kayıtlı değildir!";
        return;
    }
    //get user data
    $w = $db->db->prepare("select * from users where email=?");
    $w->execute(array(
        $email
    ));
    $result = $w->fetch(PDO::FETCH_ASSOC);
    //password check
    if ($result['password'] != md5($password)) {
        $returnArray['message'] = "Şifreniz hatalı!";
        return;
    }
    $returnArray['status'] = true;
    $returnArray['userId'] = $result['id'];
    $returnArray['message'] = "Başarılı bir şekilde giriş gerçekleştirildi!";
}
