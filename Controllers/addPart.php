<?php

namespace App\Controllers;

use App\Models\Part;
use App\Models\Device;


class addPartsController extends BaseController
{
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

    public static function addPart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect data from the form and debug
            $name = $_POST['name'];
            $device_id = $_POST['model'];
            $buyingPrice = $_POST['purchase_price'];
            $sellingPrice = $_POST['selling_price'];

            // Debug POST data
            error_log("Form data: Name: $name, Device ID: $device_id, Purchase Price: $buyingPrice, Selling Price: $sellingPrice");

            // Create an instance of the Part model and add the part
            $part = new Part();
            $result = $part->addPart($name, $device_id, $buyingPrice, $sellingPrice);

            if ($result === false) {
                error_log("Error inserting the part into the database.");
            } else {
                // Redirect to the parts page after successfully adding the part
                header('Location: /parts');
                exit();
            }
        }
    }
}