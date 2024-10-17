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
}
