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
            $_SESSION['user_type'] == 1 ? $this->userDashboard() : $this->adminDashboard();
        } else {
            include './view/signUpPage.php';
        }
    }

    public function register()
    {
        $firstName = trim(htmlspecialchars($_POST['first_name']));
        $lastName = trim(htmlspecialchars($_POST['last_name']));
        $email = trim(htmlspecialchars($_POST['email']));
        $profession = trim(htmlspecialchars($_POST['profession']));
        $age = trim(htmlspecialchars($_POST['age']));
        $password = trim(htmlspecialchars($_POST['password']));
        $address = trim(htmlspecialchars($_POST['address']));

        $errors = [];

        if (!$firstName) {
            $errors["100"] = true;
        }

        if (!$lastName) {
            $errors["101"] = true;
        }

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["102"] = true;
        }

        if (!$profession) {
            $errors["103"] = true;
        }

        if (!$age || !is_numeric($age) || $age <= 0) {
            $errors["104"] = true;
        }

        if (!$password || strlen($password) < 8) {
            $errors["105"] = true;
        }

        if (!$address) {
            $errors["106"] = true;
        }

        if (!empty($errors)) {
            $_SESSION['sign-up-errors'] = $errors;
            $this->signUpPage();
        } else {
            try {
                $user = new User();
                $user->firstName = $firstName;
                $user->lastName = $lastName;
                $user->email = $email;
                $user->profession = $profession;
                $user->age = $age;
                $user->password = $password;
                $user->address = $address;
                $userId = $user->create();

                if (!is_numeric($userId)) {
                    $errors["107"] = true;
                    $_SESSION['sign-up-errors'] = $errors;
                    include './view/signUpPage.php';
                } else {
                    $_SESSION['userId'] = $userId;
                    $this->userDashboard();
                }
            } catch (Exception $e) {
                $errors["108"] = true;
                $_SESSION['sign-up-errors'] = $errors;
                $this->signUpPage();
            }
        }
    }

    public function loginPage($errorCode = '')
    {
        if (isset($_SESSION['userId'])) {
            $this->userDashboard();
        } else {
            $redirectUrl = './view/loginPage.php';

            include $redirectUrl;
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

        if (!$errorCode) {
            $user = new User();
            $user = $user->findUser($_POST['email'], $_POST['password']);

            $errorCode = isset($user['id']) ? $errorCode : "103";

            if (!$errorCode) {
                $_SESSION['userId'] = $user['id'];
                $_SESSION['user_type'] = $user['user_type'];
                $user['user_type'] == 1 ? $this->userDashboard() : $this->adminDashboard();
            } else {
                $this->loginPage($errorCode);
            }
        } else {
            $this->loginPage($errorCode);
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
            return;
        }

        $user = new User();
        $result = $user->getUser($_SESSION['userId']);
        $_SESSION['result'] = $result;

        include './view/dashboard.php';
    }

    public function adminDashboard()
    {
        if (!$_SESSION['userId']) {
            $this->loginPage();
            return;
        }

        $user = new User();
        $result = $user->getUser($_SESSION['userId']);
        $_SESSION['result'] = $result;
        $_SESSION['admin'] = true;
        $users = $user->getAllUsers();

        include './view/adminDashboard.php';
    }

    public function updateUserInfo()
    {
        $firstName = trim(htmlspecialchars($_POST['first_name']));
        $lastName = trim(htmlspecialchars($_POST['last_name']));
        $email = trim(htmlspecialchars($_POST['email']));
        $profession = trim(htmlspecialchars($_POST['profession']));
        $age = trim(htmlspecialchars($_POST['age']));
        $address = trim(htmlspecialchars($_POST['address']));

        $errors = [];


        if (!$firstName) {
            $errors["100"] = true;
        }

        if (!$lastName) {
            $errors["101"] = true;
        }

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["102"] = true;
        }

        if (!$profession) {
            $errors["103"] = true;
        }

        if (!$age || !is_numeric($age) || $age <= 0) {
            $errors["104"] = true;
        }

        if (!$address) {
            $errors["106"] = true;
        }

        if (!empty($errors)) {
            $_SESSION['update-user-errors'] = $errors;
            $this->userDashboard();
        } else {
            $user = new User();
            $user->id = $_POST['id'];
            $user->firstName = $firstName;
            $user->lastName = $lastName;
            $user->email = $email;
            $user->profession = $profession;
            $user->age = $age;
            $user->address = $address;

            $result = $user->updateUser();

            if ($result) {
                $_SESSION['update-success-message'] = "User Details Successfully updated.";
                $this->userDashboard();
            } else {
                $errors["107"] = true;
                $_SESSION['update-user-errors'] = $errors;
                $this->userDashboard();
            }
        }
    }
}
