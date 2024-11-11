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

        return $pdo_statement->rowCount();
    }

    public function deleteRepair($repairorder_id)
    {
        $sql = "DELETE FROM repairorders WHERE id = :id";
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $repairorder_id);
        $pdo_statement->execute();

        return $pdo_statement->rowCount();
    }

    public function addRepair($customer_id, $device_id, $status, $problem, $technician_id, $image, $created_on)
    {
        $sql = "
    INSERT INTO repairorders (customer_id, device_id, status, issueReported, technician_id, image, created_on) 
    VALUES (:customer_id, :device_id, :status, :problem, :technician_id, :image, :created_on)
    ";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':customer_id', $customer_id);
        $statement->bindParam(':device_id', $device_id);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':problem', $problem);
        $statement->bindParam(':technician_id', $technician_id);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':created_on', $created_on);
        $statement->execute();

        return $repairorder_id = $this->db->lastInsertId();
    }

    public function getAllRepairOrdersWithDataDaily()
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
                p.name AS part_name
            FROM 
                repairorders ro
            LEFT JOIN 
                customers c ON ro.customer_id = c.id
            LEFT JOIN 
                devices d ON ro.device_id = d.id
            LEFT JOIN 
                technicians t ON ro.technician_id = t.id
            LEFT JOIN 
                invoices i ON ro.id = i.repairorder_id
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
    public function getAllRepairOrdersWithDataMonthly($month)
    {
        // Extract year and month from the 'Y-m' format
        list($year, $month) = explode('-', $month);

        // Use the year and month in the WHERE clause
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
                invoices i ON ro.id = i.repairorder_id
            LEFT JOIN 
                parts_repairorders pr ON ro.id = pr.repairorder_id
            LEFT JOIN 
                parts p ON pr.part_id = p.id
            WHERE 
                YEAR(ro.created_on) = :year
                AND MONTH(ro.created_on) = :month
    ";

        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':year', $year, \PDO::PARAM_INT);
        $pdo_statement->bindParam(':month', $month, \PDO::PARAM_INT);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getRepairsForMonth($month)
    {
        $sql = "
        SELECT DAY(created_on) as day, COUNT(*) as repair_count 
            FROM repairorders 
            WHERE created_on LIKE :month 
            GROUP BY DAY(created_on)
        ";

        $monthLike = $month . '%'; // Example: '2024-10%'

        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':month', $monthLike);
        $pdo_statement->execute();

        // Fetch results as an associative array
        return $pdo_statement->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public function getCompletedRepairsToday()
    {
        $sql = 'SELECT COUNT(*) as total FROM repairorders WHERE status = "completed" AND DATE(created_on) = CURDATE()';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn();
    }
}
