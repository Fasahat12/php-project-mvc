<?php

class User
{
    private $conn;
    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "admin123";
        $dbname = "project";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function create($firstName, $lastName, $email, $profession, $age, $password, $address)
    {
        try {
            $sql = "INSERT INTO users (first_name, last_name, email, profession, age, password, address)
            VALUES ('$firstName', '$lastName', '$email', '$profession', '$age', '$password', '$address')";
            $this->conn->exec($sql);

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
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
}
