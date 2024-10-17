<?php

namespace App\Models;

class Part extends BaseModel
{

    public function getAllParts()
    {
        $sql = 'SELECT * FROM parts';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }

    public function getPartById($id)
    {
        $sql = 'SELECT * FROM parts WHERE id = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $id);
        $pdo_statement->execute();

        return $pdo_statement->fetch();
    }

    public function updatePart($id, $name, $purchasePrice, $sellingPrice)
    {
        $sql = "
        UPDATE parts 
        SET name = :name, purchasePrice = :purchasePrice, sellingPrice = :sellingPrice 
        WHERE id = :id
    ";

        $pdo_statement = $this->db->prepare($sql);

        $pdo_statement->bindParam(':name', $name);
        $pdo_statement->bindParam(':purchasePrice', $purchasePrice);
        $pdo_statement->bindParam(':sellingPrice', $sellingPrice);
        $pdo_statement->bindParam(':id', $id);

        // Execute the statement and check for errors
        return $pdo_statement->execute();
    }


    public function addPart($name, $device_id, $purchasePrice, $sellingPrice)
    {
        $sql = "
    INSERT INTO parts (name, device_id, purchasePrice, sellingPrice) 
    VALUES (:name, :device_id, :purchasePrice, :sellingPrice)
    ";

        $pdo_statement = $this->db->prepare($sql);

        $pdo_statement->bindParam(':name', $name);
        $pdo_statement->bindParam(':device_id', $device_id);
        $pdo_statement->bindParam(':purchasePrice', $purchasePrice);
        $pdo_statement->bindParam(':sellingPrice', $sellingPrice);

        // Execute the statement and check for errors
        if ($pdo_statement->execute()) {
            return $this->db->lastInsertId();
        } else {
            error_log("Error adding part: " . implode(", ", $pdo_statement->errorInfo()));
            return false;
        }
    }

}

