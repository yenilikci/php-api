<?php
require_once 'Configs/database.php';
require_once 'Helpers/mainHelper.php';

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
    print_r($returnArray);
} else {
    die("Page is not found!");
}
