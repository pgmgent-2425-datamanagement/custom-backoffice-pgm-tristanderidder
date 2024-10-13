<?php

namespace App\Models;

use App\Models\BaseModel;

class Invoice extends BaseModel {
    public function totalInvoices() {
        $sql = 'SELECT COUNT(*) as total FROM invoices WHERE DATE(created_on) = CURDATE()';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn();
    }
}
