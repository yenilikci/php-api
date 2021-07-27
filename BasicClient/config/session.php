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
}
