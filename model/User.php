<?php

require_once "DbConnection.php";

class User extends DbConnection
{
    public $id;
    public $firstName;
    public $lastName;
    public $profession;
    public $age;
    public $password;
    public $email;
    public $address;

    public function create()
    {
        try {
            $sql = "INSERT INTO users (first_name, last_name, email, profession, age, password, address)
            VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->profession',
            '$this->age', '$this->password', '$this->address')";

            $this->conn->exec($sql);

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function getAllUsers($page, $itemsPerPage)
    {
        $start = ($page - 1) * $itemsPerPage;

        $stmt = $this->conn->prepare("SELECT id, email, first_name, last_name
         FROM users WHERE user_type='1' LIMIT $start, $itemsPerPage");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPages($itemsPerPage)
    {
        $totalRecords = $this->getTotalUsers();

        return ceil($totalRecords / $itemsPerPage);
    }


    public function getTotalUsers()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE user_type='1'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getUsersViaPage($page)
    {
        $users = $this->getAllUsers($page, 5);
        $totalPages = $this->getTotalPages(5);

        if ($users) {
            return [
                'status' => '200',
                'data' => $users,
                'pages' => $totalPages,
                'current_page' => $page
            ];
        } else {
            return [
                'status' => '500'
            ];
        }
    }

    public function getUser($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id='$id'");
        $stmt->execute();

        return $stmt->fetch();
    }

    public function findUser($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email='$email' AND password='$password'");
        $stmt->execute();

        return $stmt->fetch();
    }

    public function updateUser()
    {
        $sql = 'UPDATE users
                SET first_name = :first_name,
                last_name = :last_name,
                email = :email,
                profession = :profession,
                age = :age,
                address = :address
                WHERE id = :id';

        $statement = $this->conn->prepare($sql);

        $statement->bindParam(':id', $this->id, PDO::PARAM_INT);
        $statement->bindParam(':first_name', $this->firstName);
        $statement->bindParam(':last_name', $this->lastName);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':profession', $this->profession);
        $statement->bindParam(':age', $this->age);
        $statement->bindParam(':address', $this->address);

        if ($statement->execute()) {
            return true;
        }

        return false;
    }

    public function deleteUser($id)
    {
        try {
            $sql = "DELETE FROM `users` WHERE id = ?";
            $sql = $this->conn->prepare($sql);

            $sql->execute(array($id));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
