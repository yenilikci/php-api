<?php
class SessionManager
{

    static function control()
    {
        if (isset($_SESSION['email']) and isset($_SESSION['password'])) {
            return true;
        } else {
            return false;
        }
    }

    static function getInfo()
    {
        //curl post
        $ch = curl_init();
        //CURL URL
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/php-api/api/?mode=user&process=login");
        //TYPE POST
        curl_setopt($ch, CURLOPT_POST, 1);
        //DATA
        curl_setopt($ch, CURLOPT_POSTFIELDS, "email=" . $_SESSION['email'] . "&password=" . $_SESSION['password']);
        //CALLBACK TRUE
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $resultJSON = json_decode($result, true);
        return $resultJSON['userId'];
    }
}
