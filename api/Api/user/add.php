<?php
if ($_POST) {
    //strip_tags , intval filtering
    $name = MainHelper::postVariable("name");
    $surname = MainHelper::postVariable("surname");
    $email = MainHelper::postVariable("email");
    $gender = MainHelper::postIntVariable("gender");
    $password = MainHelper::postVariable("password");

    if ($name != "" and $surname != "" and $email != "" and $password != "") {
        //email format check
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $returnArray['message'] = "Email formatı hatalı";
        } else {
            //record check
            $c = $db->db->prepare("select * from users where email =?");
            $c->execute(array($email));
            $count = $c->rowCount();
            if ($count != 0) {
                $returnArray['message'] = "Bu email kullanımda!";
            } else {
                //hash password
                $password = md5($password);
                //instant date
                $date = date("Y-m-d");
                //add query
                $addQuery = $db->db->prepare("insert into users(name,surname,email,password,gender,date) values(?,?,?,?,?,?)");
                $result = $addQuery->execute(array(
                    $name,
                    $surname,
                    $email,
                    $password,
                    $gender,
                    $date
                ));
                if ($result) {
                    $returnArray['status'] = true;
                    $returnArray['message'] = "Kullanıcı başarılı bir şekilde eklendi!";
                } else {
                    $returnArray['message'] = "Kullanıcı ekleme işlemi başarısız oldu!";
                }
            }
        }
    } else {
        $returnArray['status'] = false;
        $returnArray['message'] = "Lütfen tüm alanları doldurunuz!";
    }
} else {
    die("Post işlemi yapılmamış");
}
