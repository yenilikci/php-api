<?php
//cors
header("Access-Control-Allow-Origin: *");

//set header
header("Content-Type:application/json;charset=utf8");

require_once "Routes/router.php";
require_once 'Configs/database.php';
require_once 'Helpers/mainHelper.php';
require_once 'System/controller.php';

//db conn
$db = new Database();

//secret key
$token = "mySecretKey";

//token check
if (isset($_GET['token'])) {
    if ($_GET['token'] == $token) {
        // user
        Router::start("/user/create", "userController@store");
        Router::start("/user/info/{id}", "userController@info");
        Router::start("/user/login", "userController@login");
        Router::start("/user/update", "userController@update");

        // category
        Router::start("/category/list/{id}", "categoryController@list");
        Router::start("/category/get/{id}", "categoryController@get");

        // post
        Router::start("/post/list/{id}", "postController@list");
        Router::start("/post/detail/{id}", "postController@get");

        // comment
        Router::start("/comment/store", "commentController@store");
        Router::start("/comment/get/{id}", "commentController@get");
    } else {
        die("Token Hatalı!");
    }
} else {
    die("Token Yok!");
}
