<?php

namespace App\Models;

use App\Models\BaseModel;

class Parts_Repairorder extends BaseModel {
    /**
     * The function `addPartsRepairorder` inserts a record into the parts_repairorders table with the
     * provided part_id, repairorder_id, and quantity values.
     * 
     * @param: part_id The `part_id` parameter in the `addPartsRepairorder` function represents the ID
     * of the part that you want to add to a repair order. This ID uniquely identifies the part in the
     * database and is used to associate the part with the repair order. When calling this function,
     * you should provide
     * @param: repairorder_id The `repairorder_id` parameter in the `addPartsRepairorder` function
     * represents the ID of the repair order to which you want to add a part. This function is designed
     * to insert a record into the `parts_repairorders` table linking a specific part (identified by
     * `part_id`)
     * @param: quantity The `quantity` parameter in the `addPartsRepairorder` function represents the
     * quantity of a specific part that is being added to a repair order. It indicates how many units
     * of the part are being associated with the repair order. This quantity value will be stored in
     * the `parts_repairorders`
     * 
     * @return: The function `addPartsRepairorder` is returning the last inserted ID of the record in
     * the `parts_repairorders` table after successfully adding a part to a repair order.
     */
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
