<?php

namespace App\Models;

use App\Models\BaseModel;

class Customer extends BaseModel {
    /**
     * The addCustomer function inserts a new customer record into a database table and returns the ID
     * of the newly inserted record.
     * 
     * @param: firstname First name of the customer.
     * @param: lastname The code snippet you provided is a PHP function that adds a new customer to a
     * database table. The function takes three parameters: , , and . It
     * prepares an SQL query to insert the customer's information into the "customers" table with
     * columns for firstname, lastname, and
     * @param: phone The `addCustomer` function you provided is used to insert a new customer record
     * into a database table named `customers`. The function takes three parameters: ``,
     * ``, and ``.
     * 
     * @return: The function `addCustomer` is inserting a new customer record into a database table
     * named `customers` with the provided `firstname`, `lastname`, and `phone` values. After executing
     * the SQL query, it returns the last inserted ID of the record that was added to the database.
     */
    
    public function addCustomer($firstname, $lastname, $phone)
    {
        $sql = "
        INSERT INTO customers (firstname, lastname, phonenumber) 
        VALUES (:firstname, :lastname, :phone)
    ";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':phone', $phone);
        $statement->execute();

        // Return the last inserted ID
        return $this->db->lastInsertId();
    }

}
