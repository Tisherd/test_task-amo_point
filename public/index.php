<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__ . '/../env.php';

session_start();

$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];


if ($method == 'GET'){

    if ($url == "/") {
        include __DIR__ . '/resourses/html/index.html';
    } elseif($url == "/second"){
        include __DIR__ . '/resourses/html/index2.html';
    } elseif($url == "/quasi_migration"){
        $response = \Src\Actions\CreateAndFillUserAnalytics::exec();
    } elseif($url == "/user_analytics"){        
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
            include __DIR__ . '/resourses/html/index3.html';
        } else {
            include __DIR__ . '/resourses/html/login.html';
        }
    } else {
        $response = "404 Not Found";
    }

} elseif ($method == 'POST'){
    
    if ($url == "/actions/send_text_file_form") {
        $response = \Src\Actions\SendTxtFileForm::exec();
    } elseif ($url == "/actions/get_user_analytics") {
        $response = \Src\Actions\GetUserAnalytics::exec();
    } elseif ($url == "/actions/collect_user_analytics") {
        $response = \Src\Actions\CollectUserAnalytics::exec();
    } elseif ($url == "/actions/login") {
        $response = \Src\Actions\Login::exec();
    } else {
        $response = ['code' => 404, 'message' =>'not found'];
    }

} else {
    $response = ['code' => 404, 'message' =>'not found'];
}

if (isset($response)) {
    echo json_encode($response);
}
