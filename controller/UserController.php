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
        $firstName = trim(htmlspecialchars($_POST['first_name']));
        $lastName = trim(htmlspecialchars($_POST['last_name']));
        $email = trim(htmlspecialchars($_POST['email']));
        $profession = trim(htmlspecialchars($_POST['profession']));
        $age = trim(htmlspecialchars($_POST['age']));
        $password = trim(htmlspecialchars($_POST['password']));
        $address = trim(htmlspecialchars($_POST['address']));

        // Validate each field
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

        if (!$age || !is_numeric($age) || $age < 0) {
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
                    header('Location: ./view/signUpPage.php');
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
            $redirectUrl = 'Location: ./view/loginPage.php';

            if ($errorCode) {
                $redirectUrl .= "?error_code=$errorCode";
            }

            header($redirectUrl);
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
            $result = $user->findUser($_POST['email'], $_POST['password']);

            $errorCode = isset($result['id']) ? $errorCode : "103";

            if (!$errorCode) {
                $_SESSION['userId'] = $result['id'];
                $this->userDashboard();
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
