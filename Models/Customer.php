<?php

namespace App\Models;

use App\Models\BaseModel;

class Customer extends BaseModel {
    public function addCustomer($firstname, $lastname, $phone)
    {
        $sql = "
        INSERT INTO customers (firstname, lastname, phonenumber) 
        VALUES (:firstname, :lastname, :phone)
    ";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':phone', $phone);
        $statement->execute();

        // Return the last inserted ID
        return $this->db->lastInsertId();
    }

}
