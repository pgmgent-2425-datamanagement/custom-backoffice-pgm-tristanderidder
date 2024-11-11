<?php

namespace App\Controllers;

use App\Models\RepairOrder;
use App\Models\Invoice;
use App\Models\Technician;

class HomeController extends BaseController
{
    /**
     * The index function retrieves various data related to repair orders and invoices for display on a
     * dashboard view.
     */
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

        $invoices = $invoiceModel->invoices();

        // Get All Invoices
        $totalInvoices = $invoiceModel->totalInvoices();

        // Get the current month for chart data
        $currentMonth = date('Y-m');  // Format 'YYYY-MM'
        $repairDataForMonth = $repairOrderModel->getRepairsForMonth($currentMonth);


        // Pass data to the view
        self::loadView('/home', [
            'title' => 'Dashboard',
            'totalCompletedRepairsToday' => $totalCompletedRepairsToday,  // Completed repairs for today
            'totalRepairsToday' => $totalRepairsToday,  // All repairs for today
            'repairDataForMonth' => $repairDataForMonth,  // Data for the chart
            'repairOrders' => $repairOrders,
            'invoices' => $invoices,
            'totalInvoices' => $totalInvoices,
            'updateStatus' => isset($_GET['status']) ? $_GET['status'] : null
        ]);
    }

    /**
     * The function `updateRepairOrder` checks if the request method is POST, updates the status of a
     * repair order based on the provided ID, and redirects with success or error status accordingly.
     */
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

    /**
     * The function `deleteRepairOrder` checks for a POST request, deletes a repair order and its
     * associated invoice, and redirects with success or error status accordingly.
     */
    public static function deleteRepairOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['repairorder_id'])) {
                $repairorder_id = $_POST['repairorder_id'];

                $repairOrderModel = new RepairOrder();
                $deleted = $repairOrderModel->deleteRepair($repairorder_id);


                if ($deleted) {
                    header('Location: /?status=deleted');
                    exit();
                } else {
                    header('Location: /?status=error');
                    exit();
                }
            } else {
                header('Location: /?status=error');
                exit();
            }
        } else {
            header('Location: /');
            exit();
        }
    }

    /**
     * The function `addTechnician` processes a POST request to add a new technician with specified
     * details and redirects to the homepage.
     */
    public static function addTechnician()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Technician
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
            $supervisor_id = 1;

            $technician = new Technician();
            $technician->addTechnician($name, $phone, $role, $supervisor_id);

            header('Location: /');
            exit();
        }
    }

    /**
     * The function APIgetTechnicians retrieves all technicians from the database and returns them as a
     * JSON-encoded array.
     */
    public static function APIgetTechnicians()
    {
        $part = new Technician();
        $parts = $part->getAllTechnicians();
        echo json_encode($parts);
    }

    /**
     * The function APIpostTechnicians in PHP creates a new Technician object and adds a technician
     * with specified details.
     */
    public static function APIpostTechnicians()
    {
        $part = new Technician();
        $part->addTechnician($_POST['firstname'], $_POST['lastname'], $_POST['role'], $_POST['supervisor_id']);
    }
}
