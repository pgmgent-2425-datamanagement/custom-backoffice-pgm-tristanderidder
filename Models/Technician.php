<?php

namespace App\Models;

use App\Models\BaseModel;

class Technician extends BaseModel {

    public function getAllTechnicians() {
        $sql = 'SELECT * FROM technicians';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }

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