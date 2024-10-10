<?php

namespace App\Models;

use App\Models\BaseModel;

class Repairorder extends BaseModel
{

    public function totalRepairs()
    { // Change to public
        $sql = 'SELECT COUNT(*) as total FROM repairorders WHERE status = "completed"';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn(); // Use fetchColumn to get the count
    }
}
