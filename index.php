<?php

require_once "controller/UserController.php";

$controller = new UserController();


if ($_GET['route'] == 'server-error') {
    include_once 'view/errorPage.php';
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && !$_GET['route']) {
        $controller->signUpPage();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['route'] == 'login-page') {
        $controller->loginPage();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['route'] == 'login') {
        echo $controller->login();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['route'] == 'logout') {
        $controller->logout();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['route'] == 'dashboard') {
        $controller->userDashboard();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['route'] == 'admin-dashboard') {
        $controller->adminDashboard();
    }

    if (
        $_SERVER['REQUEST_METHOD'] == 'GET'
        && $_GET['route'] == 'edit-user-page'
        && isset($_GET['id'])
    ) {
        $controller->adminEditUserPage();
    }

    if (
        $_SERVER['REQUEST_METHOD'] == 'POST'
        && $_GET['route'] == 'update-user-info'
        && isset($_POST['_method'])
        && $_POST['_method'] == 'PUT'
    ) {
        $controller->updateUserInfo();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['route'] == 'register-user') {
        $controller->register();
    }

    if (
        $_SERVER['REQUEST_METHOD'] == 'DELETE'
        && $_GET['route'] == 'delete-user'
    ) {
        $controller->deleteUser();
    }

    if (
        $_SERVER['REQUEST_METHOD'] == 'GET'
        && $_GET['route'] == 'get-users'
        && isset($_GET['page'])
    ) {
        $controller->getUsers();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['route'] == 'manage-address') {
        $controller->manageAddressPage();
    }

    if (
        $_SERVER['REQUEST_METHOD'] == 'POST'
        && $_GET['route'] == 'add-update-address'
        && !isset($_POST['_method'])
    ) {
        $controller->createUserAddress();
    }

    if (
        $_SERVER['REQUEST_METHOD'] == 'POST'
        && $_GET['route'] == 'add-update-address'
        && isset($_POST['_method'])
        && $_POST['_method'] == 'PUT'
    ) {
        $controller->updateUserAddress();
    }
}
