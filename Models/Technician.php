<?php

namespace App\Models;

use App\Models\BaseModel;

class Technician extends BaseModel {

    public function getAllTechnicians() {
        $sql = 'SELECT * FROM technicians';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }
}