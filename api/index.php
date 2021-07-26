<?php
require_once 'Configs/database.php';
require_once 'Helpers/mainHelper.php';

$db = new Database();

$returnArray = [];

$mode = $_GET["mode"];
$process = $_GET["process"];

require_once 'Api/' . $mode . '/' . $process . '.php';

print_r($returnArray);
