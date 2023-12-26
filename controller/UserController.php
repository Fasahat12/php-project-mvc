<?php

require_once "./model/User.php";
require_once "./model/Address.php";

session_start();

define("FROM_CONTROLLER", true);

class UserController
{
    public function signUpPage()
    {
        if (isset($_SESSION['userId'])) {
            $_SESSION['user_type'] == 1 ? header("Location: index.php?route=dashboard")
                : header("Location: index.php?route=admin-dashboard");
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
            header("Location: index.php");
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
                    header("Location: index.php");
                } else {
                    $_SESSION['userId'] = $userId;
                    $_SESSION['user_type'] = 1;
                    header("Location: index.php?route=dashboard");
                }
            } catch (Exception $e) {
                $errors["108"] = true;
                $_SESSION['sign-up-errors'] = $errors;
                header("Location: index.php");
            }
        }
    }

    public function loginPage()
    {
        if (isset($_SESSION['userId'])) {
            $_SESSION['user_type'] == 1 ? header("Location: index.php?route=dashboard")
                : header("Location: index.php?route=admin-dashboard");
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
                $user['user_type'] == 1 ? header("Location: index.php?route=dashboard")
                    : header("Location: index.php?route=admin-dashboard");
            } else {
                header("Location: index.php?route=login-page&error_code=$errorCode");
            }
        } else {
            header("Location: index.php?route=login-page&error_code=$errorCode");
        }
    }

    public function logout()
    {
        session_unset();

        header("Location: index.php?route=login-page");
    }

    public function userDashboard()
    {
        if (!$_SESSION['userId']) {
            header("Location: index.php?route=login-page");
            return;
        } elseif ($_SESSION['user_type'] == 2) {
            header("Location: index.php?route=admin-dashboard");
            return;
        }

        $user = new User();
        $result = $user->getUser($_SESSION['userId']);
        $_SESSION['result'] = $result;

        include './view/dashboard.php';
    }

    public function adminDashboard2()
    {
        if (!$_SESSION['userId']) {
            header("Location: index.php?route=login-page");
            return;
        } elseif ($_SESSION['user_type'] == 1) {
            header("Location: index.php?route=dashboard");
            return;
        }

        $user = new User();
        $result = $user->getUser($_SESSION['userId']);

        $_SESSION['result'] = $result;
        $_SESSION['admin'] = true;

        $users = $user->getAllUsers(1, 5);
        $totalPages = $user->getTotalPages(5);

        include './view/adminDashboard.php';
    }

    public function adminDashboard()
    {
        if (!$_SESSION['userId']) {
            header("Location: index.php?route=login-page");
            return;
        } elseif ($_SESSION['user_type'] == 1) {
            header("Location: index.php?route=dashboard");
            return;
        }

        $user = new User();
        $result = $user->getUser($_SESSION['userId']);
        $page = isset($_GET['page']) && intval($_GET['page']) ? $_GET['page'] : "1";

        $_SESSION['result'] = $result;
        $_SESSION['admin'] = true;

        $users = $user->getAllUsers($page, 5);
        $totalPages = $user->getTotalPages(5);

        include './view/adminDashboard.php';
    }


    public function getUsers()
    {
        $page = $_GET['page'];
        $user = new User();
        $users = $user->getAllUsers($page, 5);
        $totalPages = $user->getTotalPages(5);

        if ($users) {
            echo json_encode([
                'status' => '200',
                'data' => $users,
                'pages' => $totalPages,
                'current_page' => $page
            ]);
        } else {
            echo json_encode([
                'status' => '500'
            ]);
        }
    }

    public function adminEditUserPage()
    {
        if (!$_SESSION['userId']) {
            header("Location: index.php?route=login-page");
            return;
        } elseif ($_SESSION['user_type'] == 1) {
            header("Location: index.php?route=dashboard");
            return;
        }

        $user = new User();
        $result = $user->getUser($_GET['id']);
        $_SESSION['result'] = $result;

        include './view/dashboard.php';
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
            header("Location: index.php?route=dashboard");
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
                $_SESSION['user_type'] == 1 ? header("Location: index.php?route=dashboard")
                    : header("Location: index.php?route=admin-dashboard");
            } else {
                $errors["107"] = true;
                $_SESSION['update-user-errors'] = $errors;
                header("Location: index.php?route=dashboard");
            }
        }
    }

    public function deleteUser()
    {
        try {
            $user = new User();

            if ($user->deleteUser($_GET['id'])) {
                $totalPages = $user->getTotalPages(5);
                $totalUsers = $user->getTotalUsers();

                echo json_encode([
                    'status' => 200,
                    'message' => 'User Deleted Successfully!',
                    'pages' =>  $totalPages,
                    'total_user_count' => $totalUsers
                ]);
            } else {
                echo json_encode([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ]);
            }
        } catch (Exception $error) {

            echo json_encode([
                'status' => 500,
                'message' => 'Message: ' . $error->getMessage()
            ]);
        }
    }

    public function manageAddressPage()
    {
        if (!$_SESSION['userId']) {
            header("Location: index.php?route=login-page");
            return;
        } elseif ($_SESSION['user_type'] == 2) {
            header("Location: index.php?route=admin-dashboard");
            return;
        }

        $userAddress = new Address();
        $userAddress = $userAddress->get($_SESSION['userId']);
        $address = [];

        if ($userAddress) {
            $address = $userAddress;
        }

        include './view/manageAddressPage.php';
    }

    public function validateAddress()
    {
        $city = trim(htmlspecialchars($_POST['city']));
        $zipCode = trim(htmlspecialchars($_POST['zip_code']));
        $address = trim(htmlspecialchars($_POST['address']));

        $errors = [];

        if (!$city) {
            $errors["100"] = true;
        }

        if (!$zipCode) {
            $errors["101"] = true;
        }

        if (!$address) {
            $errors["102"] = true;
        }

        if (!empty($errors)) {
            $_SESSION['address-errors'] = $errors;
            header("Location: index.php?route=manage-address");

            return [
                'result' => false
            ];
        } else {
            return [
                'result' => true,
                'city' => $city,
                'zip_code' => $zipCode,
                'address' => $address
            ];
        }
    }

    public function createUserAddress()
    {
        $isValidated = $this->validateAddress();

        if ($isValidated['result']) {
            $address = new Address();
            $address->userId = $_SESSION['userId'];
            $address->city = $isValidated['city'];
            $address->zipCode = $isValidated['zip_code'];
            $address->address = $isValidated['address'];
            $address->create();

            $_SESSION['address-success-message'] = 'Address Added Successfully.';

            header("Location: index.php?route=dashboard");
        }
    }

    public function updateUserAddress()
    {
        $isValidated = $this->validateAddress();

        if ($isValidated['result']) {
            $address = new Address();
            $address->id = $_POST['id'];
            $address->city = $isValidated['city'];
            $address->zipCode = $isValidated['zip_code'];
            $address->address = $isValidated['address'];
            $address->update();

            $_SESSION['address-success-message'] = 'Address Updated Successfully.';

            header("Location: index.php?route=dashboard");
        }
    }
}
