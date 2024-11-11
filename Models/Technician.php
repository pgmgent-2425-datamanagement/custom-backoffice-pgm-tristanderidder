<?php

namespace App\Models;

use App\Models\BaseModel;

class Technician extends BaseModel {

   /**
    * The function getAllTechnicians retrieves all records from the technicians table in a database
    * using PHP and PDO.
    * 
    * @return: The `getAllTechnicians` function is returning all rows from the `technicians` table in
    * the database as an array of associative arrays. Each associative array represents a row from the
    * table with column names as keys and corresponding values.
    */
    public function getAllTechnicians() {
        $sql = 'SELECT * FROM technicians';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }

    /**
     * The addTechnician function inserts a new technician record into a database table with the
     * provided details and returns the ID of the newly inserted record.
     * 
     * @param: firstname The `addTechnician` function you provided is a PHP function that inserts a new
     * technician record into a database table. It takes four parameters: ``, ``,
     * ``, and ``.
     * @param: lastname The `lastname` parameter in the `addTechnician` function represents the last
     * name of the technician being added to the database. When calling this function, you would pass
     * the last name of the technician as a string value to be inserted into the `technicians` table in
     * the database.
     * @param: role The "role" parameter in the `addTechnician` function represents the job role or
     * position of the technician being added to the database. This could be a specific title or
     * designation such as "Senior Technician," "Junior Technician," "Lead Technician," etc. It helps
     * in categorizing and organizing technicians
     * @param: supervisor_id The `supervisor_id` parameter in the `addTechnician` function represents
     * the identifier of the supervisor to whom the technician being added will be assigned. This
     * parameter is used to establish a relationship between the newly added technician and their
     * supervisor in the database.
     * 
     * @return: The function `addTechnician` is inserting a new record into the `technicians` table with
     * the provided parameters: ``, ``, ``, and ``. After
     * executing the SQL query, it returns the last inserted ID of the record that was added to the
     * database.
     */
    public function addTechnician($firstname, $lastname, $role, $supervisor_id) {
        $sql = '
        INSERT INTO technicians (firstname, lastname, role, supervisor_id)
         VALUES (:firstname, :lastname, :role, :supervisor_id)
        ';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':firstname', $firstname);
        $pdo_statement->bindParam(':lastname', $lastname);
        $pdo_statement->bindParam(':role', $role);
        $pdo_statement->bindParam(':supervisor_id', $supervisor_id);
        $pdo_statement->execute();

        return $this->db->lastInsertId();
    }
}