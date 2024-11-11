<?php

namespace App\Models;

use App\Models\BaseModel;

class RepairOrder extends BaseModel
{

    /**
     * This PHP function retrieves the total count of repair orders marked as "completed" that were
     * created today.
     * 
     * @return: The function `totalRepairsToday()` is returning the total count of repair orders that
     * have a status of "completed" and were created today.
     */
    public function totalRepairsToday()
    {
        $sql = 'SELECT COUNT(*) as total FROM repairorders WHERE status = "completed" AND DATE(created_on) = CURDATE()';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn();
    }

    /**
     * The function `updateStatus` updates the status of a repair order to "completed" if its current
     * status is "in progress".
     * 
     * @param: repairorder_id The `updateStatus` function you provided updates the status of a repair
     * order to "completed" if the repair order is currently in progress. It takes the `repairorder_id`
     * as a parameter to identify the specific repair order to update.
     * 
     * @return: The function `updateStatus` is returning the number of rows affected by the SQL UPDATE
     * query. This value is obtained using the `rowCount()` method on the PDO statement object after
     * the query execution.
     */
    public function updateStatus($repairorder_id)
    {
        $sql = 'UPDATE repairorders SET status = "completed" WHERE id = :id AND status = "in progress"';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $repairorder_id);
        $pdo_statement->execute();

        return $pdo_statement->rowCount();
    }

    /**
     * The function `deleteRepair` deletes a repair order from the database based on the provided
     * repair order ID.
     * 
     * @param: repairorder_id The `deleteRepair` function you provided is a PHP method that deletes a
     * record from the `repairorders` table based on the `id` column matching the `repairorder_id`
     * parameter passed to the function.
     * 
     * @return: The `deleteRepair` function is deleting a record from the `repairorders` table based on
     * the provided ``. After executing the deletion query, the function returns the
     * number of rows affected by the deletion operation using `->rowCount()`. This value
     * represents the number of rows that were deleted from the table.
     */
    public function deleteRepair($repairorder_id)
    {
        $sql = "DELETE FROM repairorders WHERE id = :id";
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $repairorder_id);
        $pdo_statement->execute();

        return $pdo_statement->rowCount();
    }

    /**
     * The function `addRepair` inserts a new repair order into a database table with specified
     * details.
     * 
     * @param: customer_id The `customer_id` parameter in the `addRepair` function represents the ID of
     * the customer for whom the repair order is being created. This ID is used to associate the repair
     * order with the specific customer in the database.
     * @param: device_id The `device_id` parameter in the `addRepair` function represents the ID of the
     * device that is being repaired. This ID is used to associate the repair order with the specific
     * device that requires service. It helps in tracking and managing repairs for different devices in
     * the system.
     * @param: status The `status` parameter in the `addRepair` function represents the current status
     * of the repair order. It could indicate whether the repair is pending, in progress, completed, or
     * any other relevant status that helps track the progress of the repair process. This status
     * information can be used to manage and prioritize
     * @param: problem The `problem` parameter in the `addRepair` function represents the issue or
     * problem reported by the customer regarding the device that needs repair. This information is
     * stored in the `issueReported` column of the `repairorders` table in the database. When a repair
     * order is added using this function
     * @param: technician_id The `technician_id` parameter in the `addRepair` function represents the ID
     * of the technician assigned to work on the repair order. This ID is used to associate the repair
     * order with a specific technician who will be responsible for handling the repair of the device
     * reported by the customer.
     * @param: image The `image` parameter in the `addRepair` function represents the image associated
     * with the repair order. This could be a reference to a file path, URL, or any other identifier
     * that points to the image related to the repair. When calling the `addRepair` function, you would
     * pass the
     * @param: created_on The `created_on` parameter in the `addRepair` function represents the date and
     * time when the repair order was created. It is typically a timestamp indicating when the repair
     * request was submitted or when the repair order was added to the system. This parameter is used
     * to track the chronological order of repair orders
     * 
     * @return: The function `addRepair` is returning the ID of the newly inserted repair order
     * (``) by fetching it from the database using `->db->lastInsertId()`.
     */
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

    /**
     * The function getAllRepairOrdersWithDataDaily retrieves repair order data with related
     * information for the current date.
     * 
     * @return: The function `getAllRepairOrdersWithDataDaily` is returning an array of associative
     * arrays, where each associative array represents a repair order with various related data. The
     * keys in the associative arrays correspond to the selected columns in the SQL query. The function
     * fetches all repair orders created on the current date (`CURDATE()`) along with additional
     * information such as customer details, device details, technician details, invoice total
     */
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

    /**
     * The function `getAllRepairOrdersWithDataMonthly` retrieves repair order data for a specific
     * month and year from a database using SQL queries.
     * 
     * @param: month The function `getAllRepairOrdersWithDataMonthly` is designed to retrieve repair
     * orders along with related data for a specific month and year. The `month` parameter is expected
     * to be in the format 'Y-m', where 'Y' represents the year and 'm' represents the month.
     * 
     * @return: The function `getAllRepairOrdersWithDataMonthly` returns an array of associative arrays
     * containing data related to repair orders created in a specific month and year. The data includes
     * information such as repair order ID, issue reported, status, customer details, device details,
     * technician details, invoice total, part details, and prices associated with the parts used in
     * the repair orders.
     */
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

    /**
     * The function `getRepairsForMonth` retrieves the count of repair orders for each day in a
     * specified month from a database table.
     * 
     * @param: month The `getRepairsForMonth` function is designed to retrieve the count of repair
     * orders for each day in a given month. The `month` parameter should be in the format 'YYYY-MM',
     * representing the year and month for which you want to retrieve the repair data.
     * 
     * @return: The function `getRepairsForMonth()` is returning an associative array where the
     * keys are the day of the month and the values are the count of repair orders created on that day
     * within the specified month.
     */
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

    /**
     * The function `getCompletedRepairsToday` retrieves the count of repair orders that are marked as
     * completed and were created today.
     * 
     * @return: The `getCompletedRepairsToday` function is returning the total count of repair orders
     * that have a status of "completed" and were created today.
     */
    public function getCompletedRepairsToday()
    {
        $sql = 'SELECT COUNT(*) as total FROM repairorders WHERE status = "completed" AND DATE(created_on) = CURDATE()';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn();
    }
}
