<?php

require_once "./model/User.php";

class UserController
{
    public function __construct()
    {
    }

    public function signUpPage()
    {
        session_start();

        if ($_SESSION['userId']) {
            $this->userDashboard();
        }

        header('Location: ./view/signUpPage.php');
    }

    public function register()
    {
        try {
            $user = new User();
            $userId = $user->create(
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['profession'],
                $_POST['age'],
                $_POST['password'],
                $_POST['address']
            );
            session_start();
            $_SESSION['userId'] = $userId;

            $this->userDashboard();
        } catch (Exception $e) {
            header('Location: ./view/signUpPage.php?error_message=something-went-wrong');
        }
    }

    public function loginPage()
    {
        header('Location: ./view/loginPage.php');
    }

    public function login()
    {
        $user = new User();
        $result = $user->findUser($_POST['email'], $_POST['password']);

        if (isset($result['id'])) {
            session_start();
            $_SESSION['userId'] = $result['id'];

            $this->userDashboard();
        } else {
            $this->loginPage();
        }
    }

    public function userDashboard()
    {
        session_start();
        $userId = $_SESSION['userId'];

        if (!$_SESSION['userId']) {
            $this->userDashboard();
        }

        $user = new User();
        $result = $user->getUser($userId);
        $_SESSION['result'] = $result;

        header('Location: ./view/dashboard.php');
    }
}
