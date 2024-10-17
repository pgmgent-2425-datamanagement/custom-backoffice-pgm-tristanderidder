<?php

namespace App\Models;

use App\Models\BaseModel;

class Part extends BaseModel {

    public function getAllParts() {
        $sql = 'SELECT * FROM parts';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
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

