<?php

require_once "DbConnection.php";

class Address extends DbConnection
{
    public $id;
    public $userId;
    public $zipCode;
    public $city;
    public $address;

    public function create()
    {
        try {
            $sql = "INSERT INTO delivery_addresses (user_id, zip_code, city, address)
            VALUES ('$this->userId', '$this->zipCode', '$this->city', '$this->address')";

            $this->conn->exec($sql);

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update()
    {
        $sql = 'UPDATE delivery_addresses
                SET
                zip_code = :zip_code,
                city = :city,
                address = :address
                WHERE id = :id';

        $statement = $this->conn->prepare($sql);

        $statement->bindParam(':id', $this->id, PDO::PARAM_INT);
        $statement->bindParam(':zip_code', $this->zipCode);
        $statement->bindParam(':city', $this->city);
        $statement->bindParam(':address', $this->address);

        if ($statement->execute()) {
            return true;
        }

        return false;
    }

    public function get($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM delivery_addresses
         WHERE user_id='$id'");
        $stmt->execute();

        return $stmt->fetch();
    }
}
