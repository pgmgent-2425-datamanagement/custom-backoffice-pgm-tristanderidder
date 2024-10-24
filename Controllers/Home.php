<?php

namespace App\Controllers;

use App\Models\RepairOrder;
use App\Models\Invoice;

class HomeController extends BaseController
{
    public static function index()
    {
        $repairOrderModel = new RepairOrder();
        $invoiceModel = new Invoice();

        // Get total number of completed repairs today
        $totalCompletedRepairsToday = $repairOrderModel->getCompletedRepairsToday();

        // Get total number of repairs today
        $totalRepairsToday = $repairOrderModel->totalRepairsToday();

        // Get all repair orders with details
        $repairOrders = $repairOrderModel->getAllRepairOrdersWithDataDaily();

        // Get All Invoices
        $totalInvoices = $invoiceModel->totalInvoices();

        // Pass data to the view
        self::loadView('/home', [
            'title' => 'Dashboard',
            'totalCompletedRepairsToday' => $totalCompletedRepairsToday,  // Completed repairs for today
            'totalRepairsToday' => $totalRepairsToday,  // All repairs for today
            'repairOrders' => $repairOrders,
            'totalInvoices' => $totalInvoices,
            'updateStatus' => isset($_GET['status']) ? $_GET['status'] : null
        ]);
    }

    public static function updateRepairOrder()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the repairorder_id exists in POST data
            if (isset($_POST['repairorder_id'])) {
                $repairorder_id = $_POST['repairorder_id'];

                // Assume we have the RepairOrder model available
                $repairOrderModel = new RepairOrder();

                // Call the update method
                $updated = $repairOrderModel->updateStatus($repairorder_id);

                if ($updated) {
                    // Redirect back with a success status
                    header('Location: /?status=updated');
                    exit();
                } else {
                    // Handle the error case
                    header('Location: /?status=error');
                    exit();
                }
            } else {
                // Handle case where repairorder_id is not set
                header('Location: /?status=error');
                exit();
            }
        } else {
            // If not a POST request, redirect or handle appropriately
            header('Location: /');
            exit();
        }
    }
    public static function deleteRepairOrder()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the repairorder_id exists in POST data
            if (isset($_POST['repairorder_id'])) {
                $repairorder_id = $_POST['repairorder_id'];

                // Assume we have the RepairOrder model available
                $repairOrderModel = new RepairOrder();

                // Call the update method
                $updated = $repairOrderModel->updateStatus($repairorder_id);

                if ($updated) {
                    // Redirect back with a success status
                    header('Location: /?status=updated');
                    exit();
                } else {
                    // Handle the error case
                    header('Location: /?status=error');
                    exit();
                }
            } else {
                // Handle case where repairorder_id is not set
                header('Location: /?status=error');
                exit();
            }
        } else {
            // If not a POST request, redirect or handle appropriately
            header('Location: /');
            exit();
        }
    }
}
