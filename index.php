<?php

require_once "controller/UserController.php";

$controller = new UserController();


if ($_SERVER['REQUEST_METHOD'] == 'GET' && !$_GET['route']) {
    $controller->signUpPage();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['route'] == 'login-page') {
    $controller->loginPage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['route'] == 'login') {
    $controller->login();
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['route'] == 'dashboard') {
    $controller->userDashboard();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['route'] == 'register-user') {
    $controller->register();
}
