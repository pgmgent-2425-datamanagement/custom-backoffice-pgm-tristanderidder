<?php

namespace App\Models;

use App\Models\BaseModel;

class Invoice extends BaseModel
{
    public function totalInvoices()
    {
        $sql = 'SELECT COUNT(*) as total FROM invoices WHERE DATE(created_on) = CURDATE()';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn();
    }

    public function addInvoice($price, $repairorder_id)
    {
        $sql = "
        INSERT INTO invoices (total, repairorder_id) 
        VALUES (:price, :repairorder_id)
    ";

        // Prepare the SQL statement
        $statement = $this->db->prepare($sql);

        // Bind parameters
        $statement->bindParam(":price", $price);
        $statement->bindParam(":repairorder_id", $repairorder_id);

        // Execute the query and check if it fails
        if (!$statement->execute()) {
            // Log the error if there is a problem with the query
            error_log("Error adding invoice: " . implode(", ", $statement->errorInfo()));
            return false; // Return false or handle error as needed
        }

        // Return the last inserted invoice ID if successful
        return $this->db->lastInsertId();
    }


}
