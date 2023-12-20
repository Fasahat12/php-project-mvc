<?php

require_once "./model/User.php";

session_start();

class UserController
{
    public function __construct()
    {
    }

    public function signUpPage()
    {
        if (isset($_SESSION['userId'])) {
            $this->userDashboard();
        } else {
            header('Location: ./view/signUpPage.php');
        }
    }

    public function register()
    {
        try {
            $user = new User();
            $user->firstName = $_POST['first_name'];
            $user->lastName = $_POST['last_name'];
            $user->email = $_POST['email'];
            $user->profession = $_POST['profession'];
            $user->age = $_POST['age'];
            $user->password = $_POST['password'];
            $user->address = $_POST['address'];
            $userId = $user->create();

            if (!is_numeric($userId)) {
                header('Location: ./view/signUpPage.php?error_code=100');
            } else {
                $_SESSION['userId'] = $userId;
                $this->userDashboard();
            }
        } catch (Exception $e) {
            header('Location: ./view/signUpPage.php?error_code=101');
        }
    }

    public function loginPage()
    {
        if (isset($_SESSION['userId'])) {
            $this->userDashboard();
        } else {
            header('Location: ./view/loginPage.php');
        }
    }

    public function login()
    {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $errorCode = '';
    
        if (!$email) {
            $errorCode = "100";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorCode = "101";
        } elseif (!$password) {
            $errorCode = "102";
        }

        $user = new User();
        $result = $user->findUser($_POST['email'], $_POST['password']);

        if (isset($result['id'])) {
            $_SESSION['userId'] = $result['id'];

            $this->userDashboard();
        } else {
            $this->loginPage();
        }
    }

    public function logout()
    {
        session_unset();

        $this->loginPage();
    }

    public function userDashboard()
    {
        if (!$_SESSION['userId']) {
            $this->loginPage();
        }

        $user = new User();
        $result = $user->getUser($_SESSION['userId']);
        $_SESSION['result'] = $result;

        header('Location: ./view/dashboard.php');
    }

    public function updateUserInfo()
    {
        $user = new User();
        $user->id = $_POST['id'];
        $user->firstName = $_POST['first_name'];
        $user->lastName = $_POST['last_name'];
        $user->email = $_POST['email'];
        $user->profession = $_POST['profession'];
        $user->age = $_POST['age'];
        $user->address = $_POST['address'];

        $result = $user->updateUser();

        if ($result) {
            $this->userDashboard();
        } else {
            header('Location: ./view/dashboard.php?error_message=something-went-wrong');
        }
    }
}
