<?php

namespace App\Controllers;

use App\Models\Part;

class PartsController extends BaseController
{
    /**
     * The index function retrieves all parts from the database and loads a view with the parts data.
     */
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
    /**
     * The function `updatePart` in PHP collects form data, updates a part using the Part model, and
     * optionally redirects to the parts page with updated data.
     */
    public static function updatePart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Parts
            $partId = $_POST['id'];
            $name = $_POST['name'];
            $purchasePrice = $_POST['purchasePrice'];
            $sellingPrice = $_POST['sellingPrice'];

            $part = new Part();
            $part->updatePart($partId, $name, $purchasePrice, $sellingPrice);

            header('Location: /parts'); // This will refresh the parts page with updated data
            exit();
        }
    }

    // Handle the part deletion logic
    /**
     * The function `deletePart` deletes a part using POST method and redirects back to the parts page.
     */
    public static function deletePart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partId = $_POST['id'];

            $part = new Part();
            $part->deletePart($partId);

            // Optionally redirect back to the parts page
            header('Location: /parts'); // This will refresh the parts page
            exit();
        }
    }
}
