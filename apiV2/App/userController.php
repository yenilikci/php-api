<?php
class userController extends Controller
{
    public function store()
    {
        $returnArray = [];
        //default status res
        $returnArray['status'] = false;

        if ($_POST) {
            //strip_tags , intval filtering
            $name = MainHelper::postVariable("name");
            $surname = MainHelper::postVariable("surname");
            $email = MainHelper::postVariable("email");
            $gender = MainHelper::postIntVariable("gender");
            $password = MainHelper::postVariable("password");

            //field check
            if ($name != "" and $surname != "" and $email != "" and $password != "") {
                //email format check
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $returnArray['message'] = "Email formatı hatalı";
                    return;
                }

                //record check
                $c = $this->db->prepare("select * from users where email =?");
                $c->execute(array($email));
                $count = $c->rowCount();
                if ($count != 0) {
                    $returnArray['message'] = "Bu email kullanımda!";
                    return;
                }

                //hash password
                $password = md5($password);
                //instant date
                $date = date("Y-m-d");
                //add query
                $addQuery = $this->db->prepare("insert into users(name,surname,email,password,gender,date) values(?,?,?,?,?,?)");
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
                    $returnArray['userId'] =  $this->db->lastInsertId();
                    $returnArray['message'] = "Kullanıcı başarılı bir şekilde eklendi!";
                } else {
                    $returnArray['message'] = "Kullanıcı ekleme işlemi başarısız oldu!";
                }
            } else {
                $returnArray['status'] = false;
                $returnArray['message'] = "Lütfen tüm alanları doldurunuz!";
            }
            //convert json
            echo json_encode($returnArray);
        } else {
            die("Post işlemi yapılmamış");
        }
    }

    public function info($id)
    {
        $returnArray = [];
        //default status res
        $returnArray['status'] = false;

        //record check
        $c = $this->db->prepare("select * from users where id=?");
        $c->execute(array(
            $id
        ));
        $count = $c->rowCount();
        if ($count == 0) {
            $returnArray['message'] = "Böyle bir kullanıcı bulunamadı!";
            return;
        }
        //get user data
        $w = $this->db->prepare("select * from users where id=?");
        $w->execute(array(
            $id
        ));
        $result = $w->fetch(PDO::FETCH_ASSOC);

        //response
        $returnArray['data'] = $result;
        $returnArray['status'] = true;
        $returnArray['message'] = $id . " id'li kullanıcı verileri başarıyla getirildi!";

        //convert json
        echo json_encode($returnArray);
    }

    public function login()
    {
        if ($_POST) {
            $returnArray = [];
            //default status res
            $returnArray['status'] = false;

            $email = MainHelper::postVariable("email");
            $password = MainHelper::postVariable("password");

            //field check
            if ($email == "" or $password == "") {
                $returnArray['message'] = "Lütfen tüm alanları doldurunuz";
                return;
            }
            //record check
            $c = $this->db->prepare("select * from users where email=?");
            $c->execute(array(
                $email
            ));
            $count = $c->rowCount();
            if ($count == 0) {
                $returnArray['message'] = "Email sistemde kayıtlı değildir!";
                return;
            }
            //get user data
            $w = $this->db->prepare("select * from users where email=?");
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

            //convert json
            echo json_encode($returnArray);
        }
    }

    public function update()
    {
        if ($_POST) {
            $returnArray = [];
            //default status res
            $returnArray['status'] = false;

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
            $c = $this->db->prepare("select * from users where id=?");
            $c->execute(array(
                $id
            ));
            $count = $c->rowCount();
            if ($count == 0) {
                $returnArray['message'] = "Böyle bir kullanıcı yok";
                return;
            }

            //email using check
            $cEmail = $this->db->prepare("select * from users where id!=? and email=?");
            $cEmail->execute(array(
                $id,
                $email
            ));
            $countEmail = $cEmail->rowCount();
            if ($countEmail != 0) {
                $returnArray['message'] = "Bu email kullanımda";
            }

            $w = $this->db->prepare("select * from users where id=?");
            $w->execute(array(
                $id
            ));
            $result = $w->fetch(PDO::FETCH_ASSOC);
            //password required check
            if ($password == "") {
                $password = $result['password'];
            }

            //update
            $updateQuery = $this->db->prepare("update users set name=?, surname=?, email=? , password =? , gender=? where id=?");
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

            //convert json
            echo json_encode($returnArray);
        }
    }
}
