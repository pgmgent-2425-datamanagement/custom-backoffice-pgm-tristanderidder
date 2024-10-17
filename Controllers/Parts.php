<?php

namespace App\Controllers;

use App\Models\Part;

class PartsController extends BaseController
{
    public static function index()
    {
        $part = new Part();
        $parts = $part->getAllParts();

        self::loadView('/parts', [
            'title' => 'Parts',
            'parts' => $parts
        ]);
    }

    // Handle the part update logic
    public static function updatePart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect data from the form
            $partId = $_POST['id'];
            $name = $_POST['name'];
            $purchasePrice = $_POST['purchasePrice'];
            $sellingPrice = $_POST['sellingPrice'];

            // Create an instance of the Part model and update the part
            $part = new Part();
            $part->updatePart($partId, $name, $purchasePrice, $sellingPrice);

            // Optionally redirect back to the same page or reload the parts
            header('Location: /parts'); // This will refresh the parts page with updated data
            exit();
        }
    }

    // Handle the part deletion logic
    public static function deletePart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partId = $_POST['id'];

            // Create an instance of the Part model and delete the part
            $part = new Part();
            $part->deletePart($partId);

            // Optionally redirect back to the parts page
            header('Location: /parts'); // This will refresh the parts page
            exit();
        }
    }
}
