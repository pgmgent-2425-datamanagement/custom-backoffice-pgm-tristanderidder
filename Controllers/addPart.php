<?php

namespace App\Controllers;

use App\Models\Part;
use App\Models\Device;


class addPartsController extends BaseController
{
    /**
     * Handles the index action for adding a part.
     * 
     * This method retrieves all devices and parts, then loads the 'addPart' view
     * with the retrieved data.
     * 
     * @return void
     */
    public static function index()
    {

        $device = new Device();
        $devices = $device->getAllDevices();

        $parts = new Part();
        $parts = $parts->getAllParts();

        self::loadView('/addPart', [
            'title' => 'Add Part',
            'devices' => $devices,
            'parts' => $parts
        ]);
    }

    /**
     * The function `addPart` collects data from a form, creates an instance of the Part model, and
     * adds a part to the database, redirecting to the parts page upon success.
     */
    public static function addPart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $device_id = $_POST['model'];
            $buyingPrice = $_POST['purchase_price'];
            $sellingPrice = $_POST['selling_price'];

            error_log("Form data: Name: $name, Device ID: $device_id, Purchase Price: $buyingPrice, Selling Price: $sellingPrice");

            $part = new Part();
            $result = $part->addPart($name, $device_id, $buyingPrice, $sellingPrice);

            if ($result === false) {
                error_log("Error inserting the part into the database.");
            } else {
                header('Location: /parts');
                exit();
            }
        }
    }
}