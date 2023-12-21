<?php

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

session_start();
$user = $_SESSION['result'];

if (isset($_SESSION['update-user-errors'])) {
    $errors = $_SESSION['update-user-errors'];
    unset($_SESSION['update-user-errors']);
}

require_once "ui-component/editUserForm.php";
require_once "ui-component/footer.php";
