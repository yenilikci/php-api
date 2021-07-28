<?php

//cors
header("Access-Control-Allow-Origin: *");

//set header
header("Content-Type:application/json;charset=utf8");

//secret key
$token = "mySecretKey";

require_once 'Configs/database.php';
require_once 'Helpers/mainHelper.php';

//db conn
$db = new Database();

$returnArray = [];
//default status res
$returnArray['status'] = false;

//token check
if (isset($_GET['token'])) {
    if ($_GET['token'] == $token) {
        $mode = $_GET["mode"];
        $process = $_GET["process"];

        $path = 'Api/' . $mode . '/' . $process . '.php';

        //file control
        if (file_exists($path)) {
            require_once 'Api/' . $mode . '/' . $process . '.php';
            //convert json
            echo json_encode($returnArray);
        } else {
            die("Page is not found!");
        }
    } else {
        die("Token Hatalı!");
    }
} else {
    die("Token Yok!");
}
