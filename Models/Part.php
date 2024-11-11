<?php

namespace App\Models;

class Part extends BaseModel
{
    /**
     * The function getAllParts retrieves all parts from a database table named parts.
     * 
     * @return: The `getAllParts()` function is returning all rows from the "parts" table in the
     * database as an array of associative arrays. Each associative array represents a row from the
     * table with column names as keys and corresponding values.
     */
    public function getAllParts()
    {
        $sql = 'SELECT * FROM parts';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->execute();

        return $pdo_statement->fetchAll();
    }

    /**
     * The function `getPartById` retrieves a part from the database based on the provided ID.
     * 
     * @param: id The `getPartById` function is a PHP function that retrieves a part from a database
     * table named `parts` based on the provided `id`. The function prepares a SQL query to select all
     * columns (`*`) from the `parts` table where the `id` column matches the parameter `:
     * 
     * @return: The `getPartById` function is returning the result of the SQL query that selects all
     * columns from the `parts` table where the `id` column matches the provided ``. The function
     * fetches and returns the first row of the result set as an associative array.
     */
    public function getPartById($id)
    {
        $sql = 'SELECT * FROM parts WHERE id = :id';
        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $id);
        $pdo_statement->execute();

        return $pdo_statement->fetch();
    }

    /**
     * The function `updatePart` updates a part's name, purchase price, and selling price in the
     * database based on the provided ID.
     * 
     * @param: id The `id` parameter in the `updatePart` function represents the unique identifier of
     * the part that you want to update in the database. This identifier is used to locate the specific
     * part record that needs to be updated with the new values provided for `name`, `purchasePrice`,
     * and `sellingPrice
     * @param: name The `name` parameter represents the updated name of the part that you want to change
     * in the database. When calling the `updatePart` function, you would pass the new name value for
     * the part with the corresponding `id`.
     * @param: purchasePrice Purchase price is the cost at which the part is acquired from the supplier
     * or manufacturer. It represents the amount of money spent to purchase the part before any
     * additional costs or markups.
     * @param: sellingPrice The `updatePart` function you provided is used to update a part in a
     * database table named `parts`. It takes four parameters: ``, ``, ``, and
     * ``. The SQL query updates the `name`, `purchasePrice`, and `sellingPrice` columns
     * 
     * @return: The `execute()` method is being called on the prepared statement ``. This
     * method executes the prepared statement and returns a boolean value indicating whether the
     * execution was successful or not.
     */
    public function updatePart($id, $name, $purchasePrice, $sellingPrice)
    {
        $sql = "
        UPDATE parts 
        SET name = :name, purchasePrice = :purchasePrice, sellingPrice = :sellingPrice 
        WHERE id = :id
    ";

        $pdo_statement = $this->db->prepare($sql);

        $pdo_statement->bindParam(':name', $name);
        $pdo_statement->bindParam(':purchasePrice', $purchasePrice);
        $pdo_statement->bindParam(':sellingPrice', $sellingPrice);
        $pdo_statement->bindParam(':id', $id);

        // Execute the statement and check for errors
        return $pdo_statement->execute();
    }

    /**
     * The function `deletePart` deletes a record from the `parts` table based on the provided ID.
     * 
     * @param: id The `deletePart` function is a PHP method that deletes a record from a database table
     * named `parts` based on the provided `id` parameter. The `id` parameter is used to identify the
     * specific record that needs to be deleted from the database table.
     * 
     * @return: The `execute()` method is being called on the prepared statement ``. This
     * method executes the prepared statement and returns a boolean value indicating whether the
     * execution was successful or not. The return value of the `execute()` method is being returned
     * from the `deletePart()` function.
     */
    public function deletePart($id)
    {
        $sql = "DELETE FROM parts WHERE id = :id";

        $pdo_statement = $this->db->prepare($sql);
        $pdo_statement->bindParam(':id', $id);

        // Execute the statement and check for errors
        return $pdo_statement->execute();
    }

    /**
     * The function `addPart` inserts a new part record into a database table with the provided name,
     * device ID, purchase price, and selling price.
     * 
     * @param: name The `name` parameter in the `addPart` function represents the name of the part that
     * you want to add to the database. When calling this function, you would pass the name of the part
     * as a string value. For example, if you are adding a "CPU" part, you would
     * @param: device_id The `device_id` parameter in the `addPart` function represents the ID of the
     * device to which the part belongs. When adding a new part to the database, you need to specify
     * the `device_id` to associate the part with a particular device. This helps in organizing and
     * categorizing parts
     * @param: purchasePrice Purchase price is the cost at which the part is acquired from the supplier
     * or manufacturer. It is the price paid to purchase the part before any additional costs or
     * markups are applied.
     * @param: sellingPrice The `sellingPrice` parameter in the `addPart` function represents the price
     * at which the part will be sold. It is the amount that the customer will pay when purchasing the
     * part. This value is typically set by the seller based on factors such as cost, market demand,
     * and desired profit margin
     * 
     * @return: The `addPart` function is returning the ID of the newly inserted part if the insertion
     * was successful. If there is an error during the insertion process, it logs an error message and
     * returns `false`.
     */
    public function addPart($name, $device_id, $purchasePrice, $sellingPrice)
    {
        $sql = "
    INSERT INTO parts (name, device_id, purchasePrice, sellingPrice) 
    VALUES (:name, :device_id, :purchasePrice, :sellingPrice)
    ";

        $pdo_statement = $this->db->prepare($sql);

        $pdo_statement->bindParam(':name', $name);
        $pdo_statement->bindParam(':device_id', $device_id);
        $pdo_statement->bindParam(':purchasePrice', $purchasePrice);
        $pdo_statement->bindParam(':sellingPrice', $sellingPrice);

        // Execute the statement and check for errors
        if ($pdo_statement->execute()) {
            return $this->db->lastInsertId();
        } else {
            error_log("Error adding part: " . implode(", ", $pdo_statement->errorInfo()));
            return false;
        }
    }
}
