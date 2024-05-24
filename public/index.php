<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__ . '/../env.php';


$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];


if ($method == 'GET'){

    if ($url == "/") {
        include 'index.html';
    } elseif($url == "/second"){
        include 'index2.html';
    } elseif($url == "/quasi_migration"){
        $response = \Src\Actions\CreateAndFillUserAnalytics::exec();
    } elseif($url == "/user_analytics"){
        include 'index3.html';
    } else {
        $response = "<h1>404 Not Found</h1>";
    }

} elseif ($method == 'POST'){
    

    if ($url == "/actions/send_text_file_form") {
        $response = \Src\Actions\SendTxtFileForm::exec();
    } elseif ($url == "/actions/get_user_analytics") {
        $response = \Src\Actions\GetUserAnalytics::exec();
    } elseif ($url == "/actions/collect_user_analytics") {
        $response = \Src\Actions\CollectUserAnalytics::exec();
    } else {
        $response = ['code' => 404, 'message' =>'not found'];
    }

} else {
    $response = ['code' => 404, 'message' =>'not found'];
}

if (isset($response)) {
    echo json_encode($response);
}
