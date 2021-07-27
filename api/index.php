<?php

//set header
header("Content-Type:application/json;charset=utf8");

require_once 'Configs/database.php';
require_once 'Helpers/mainHelper.php';

//db conn
$db = new Database();

$returnArray = [];
//default status res
$returnArray['status'] = false;

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
