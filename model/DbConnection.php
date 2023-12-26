<?php

class DbConnection
{
    protected $conn;

    public function __construct()
    {
        if (!$this->connect()) {
            header('Location: index.php?route=server-error');
        }
    }

    protected function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "admin123";
        $dbname = "project";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
