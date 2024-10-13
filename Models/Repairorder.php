<?php

namespace App\Models;

use App\Models\BaseModel;

class RepairOrder extends BaseModel
{

    public function totalRepairsToday()
    {
        $sql = 'SELECT COUNT(*) as total FROM repairorders WHERE status = "completed" AND DATE(created_on) = CURDATE()';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn();
    }

    public function updateStatus($repairorder_id)
    {
        $sql = 'UPDATE repairorders SET status = "completed" WHERE id = :id AND status = "in progress"';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $repairorder_id);
        $pdo_statement->execute();

        return $pdo_statement->rowCount(); // This will return the number of rows affected
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
                p.name AS part_name,
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
            LEFT JOIN 
                parts p ON pr.part_id = p.id
            WHERE DATE(ro.created_on) = CURDATE();
        ";

        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
