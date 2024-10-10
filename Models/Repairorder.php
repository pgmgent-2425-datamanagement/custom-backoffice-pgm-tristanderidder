<?php

namespace App\Models;

use App\Models\BaseModel;

class RepairOrder extends BaseModel
{

    public function totalRepairs()
    {
        $sql = 'SELECT COUNT(*) as total FROM repairorders WHERE status = "completed"';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn(); // Correctly fetching the total count
    }


    public function getAllRepairOrdersWithData()
    {
        $sql = "
            SELECT 
                ro.id AS repairorder_id,
                ro.issueReported,
                ro.status,
                c.firstname AS customer_firstname,
                c.lastname AS customer_lastname,
                d.type AS device_type,
                d.brand AS device_brand,
                d.model AS device_model,
                t.firstname AS technician_firstname,
                t.lastname AS technician_lastname,
                i.total AS invoice_total,
                pr.part_id AS part_id,
                pr.quantity AS part_quantity,
                pr.sellingPriceAtRepair AS part_selling_price,
                pr.purchasePriceAtRepair AS part_purchase_price
            FROM 
                repairorders ro
            LEFT JOIN 
                customers c ON ro.customer_id = c.id
            LEFT JOIN 
                devices d ON ro.device_id = d.id
            LEFT JOIN 
                technicians t ON ro.technician_id = t.id
            LEFT JOIN 
                invoices i ON ro.id = i.repairorder
            LEFT JOIN 
                parts_repairorders pr ON ro.id = pr.repairorder_id
        ";

        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
