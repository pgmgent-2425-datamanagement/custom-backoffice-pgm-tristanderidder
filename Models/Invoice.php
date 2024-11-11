<?php

namespace App\Models;

use App\Models\BaseModel;

class Invoice extends BaseModel
{
    /**
     * This PHP function retrieves all records from the "invoices" table in a database using a prepared
     * statement.
     * 
     * @return: The `invoices()` function is returning all rows from the "invoices" table in the
     * database as an array of associative arrays. Each associative array represents a row from the
     * table with column names as keys and corresponding values.
     */
    public function invoices()
    {
        $sql = 'SELECT * FROM invoices';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }
    
    /**
     * The function `totalInvoices` retrieves the count of invoices created on the current date from a
     * database table.
     * 
     * @return: The total number of invoices created today is being returned.
     */
    public function totalInvoices()
    {
        $sql = 'SELECT COUNT(*) as total FROM invoices WHERE DATE(created_on) = CURDATE()';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchColumn();
    }

    /**
     * The function `addInvoice` inserts a new invoice record into the database with the provided price
     * and repair order ID, handling errors and returning the last inserted invoice ID if successful.
     * 
     * @param: price The `price` parameter in the `addInvoice` function represents the total amount of
     * the invoice that you want to add to the database. This amount will be associated with the
     * specified repair order ID. When calling this function, you should provide the numerical value of
     * the total price for the invoice you are
     * @param: repairorder_id The `repairorder_id` parameter in the `addInvoice` function represents the
     * ID of the repair order associated with the invoice being added. This ID is used to link the
     * invoice to the specific repair order in the database. When adding a new invoice, you need to
     * provide the `repairorder_id
     * 
     * @return: the last inserted invoice ID if the insertion was successful. If there is an error
     * during the execution of the query, it will log the error and return false.
     */
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

    /**
     * This PHP function deletes an invoice from the database based on the provided repair order ID.
     * 
     * @param: repairorder_id The `deleteInvoice` function you provided is used to delete an invoice
     * from the `invoices` table based on the `id` column. The `repairorder_id` parameter is the ID of
     * the invoice that you want to delete.
     * 
     * @return: The `deleteInvoice` function is returning the number of rows affected by the DELETE
     * query executed on the `invoices` table where the `id` matches the provided ``.
     */
    public function deleteInvoice($repairorder_id)
    {
        $sql = "DELETE FROM invoices WHERE id = :id";
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $repairorder_id);
        $pdo_statement->execute();

        return $pdo_statement->rowCount();
    }

}
