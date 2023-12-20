<?php

class DbConnection
{
    protected $conn;
    protected function connect()
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
            return "Connection Successful.";
        } catch (PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }
}
