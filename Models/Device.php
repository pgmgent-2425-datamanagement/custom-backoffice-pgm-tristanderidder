<?php

namespace App\Models;

use App\Models\BaseModel;

class Device extends BaseModel {

    public function getAllDevices() {
        $sql = 'SELECT * FROM devices';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }
    public function checkModelExists($device_id, $brand_id, $model_number)
    {
        $sql = "SELECT COUNT(*) FROM devices WHERE id = :device_id AND brand = :brand_id AND model = :model_number";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':device_id', $device_id);
        $statement->bindParam(':brand_id', $brand_id);
        $statement->bindParam(':model_number', $model_number);
        $statement->execute();

        return $statement->fetchColumn() > 0;
    }

    
}
