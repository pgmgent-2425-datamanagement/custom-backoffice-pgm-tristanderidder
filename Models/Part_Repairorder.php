<?php

namespace App\Models;

use App\Models\BaseModel;

class Parts_Repairorder extends BaseModel {
    public function addPartsRepairorder($part_id, $repairorder_id, $quantity) {
        $sql = "
            INSERT INTO parts_repairorders (part_id, repairorder_id, quantity) 
            VALUES (:part_id, :repairorder_id, :quantity)
        ";

        $statement = $this->db->prepare($sql);

        $statement->bindParam(":part_id", $part_id);
        $statement->bindParam(":repairorder_id", $repairorder_id);
        $statement->bindParam(":quantity", $quantity);

        if (!$statement->execute()) {
            error_log("Error adding part to repairorder: " . implode(", ", $statement->errorInfo()));
            return false;
        }

        return $this->db->lastInsertId();
    }
}
