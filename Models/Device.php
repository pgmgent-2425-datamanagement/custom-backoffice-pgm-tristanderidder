<?php

namespace App\Models;

use App\Models\BaseModel;

class Device extends BaseModel {

    /**
     * This PHP function retrieves all devices from a database table named "devices".
     * 
     * @return `getAllDevices` function is returning all rows from the `devices` table in the
     * database as an array of associative arrays. Each associative array represents a row in the table
     * with column names as keys and corresponding values.
     */
    public function getAllDevices() {
        $sql = 'SELECT * FROM devices';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }

    /**
     * The function `checkModelExists` checks if a specific device model exists in the database based
     * on the provided device ID, brand ID, and model number.
     * 
     * @param: device_id Device ID is the unique identifier for a specific device in the database. It is
     * used to distinguish one device from another.
     * @param: brand_id Brand ID is a unique identifier for a specific brand of devices. It is used to
     * distinguish between different brands in the database.
     * @param: model_number The `checkModelExists` function you provided is a PHP method that checks if
     * a specific device model exists in the database based on the provided device ID, brand ID, and
     * model number.
     * 
     * @return: The function `checkModelExists` is returning a boolean value. It checks if there is at
     * least one record in the `devices` table where the `id` matches the ``, the `brand`
     * matches the ``, and the `model` matches the ``. If there is at least one
     * matching record, it returns `true`, otherwise it returns `false`.
     */
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
