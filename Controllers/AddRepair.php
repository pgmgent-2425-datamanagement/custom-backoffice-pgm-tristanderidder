<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Technician;
use App\Models\RepairOrder;
use App\Models\Device;
use App\Models\Invoice;
use App\Models\Part;
use App\Models\Parts_Repairorder;

class addRepairController extends BaseController
{
    /**
     * The index function retrieves all technicians, devices, and parts and loads a view for adding a
     * repair with the retrieved data.
     */
    public static function index()
    {
        $technician = new Technician();
        $technicians = $technician->getAllTechnicians();

        $device = new Device();
        $devices = $device->getAllDevices();

        $parts = new Part();
        $parts = $parts->getAllParts();

        self::loadView('/addRepair', [
            'title' => 'Add Repair',
            'technicians' => $technicians,
            'devices' => $devices,
            'parts' => $parts
        ]);
    }

    /**
     * The function `addRepair` processes a form submission to add a repair order, customer, invoice,
     * and selected parts to the database.
     */
    public static function addRepair()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];

            $to_folder = BASE_DIR . '/public/images/';

            $uuid = uniqid() . '-' . $name;

            move_uploaded_file($tmp, $to_folder . $uuid);

            // Customer
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];

            $customerModel = new Customer();
            $customer_id = $customerModel->addCustomer($firstname, $lastname, $phone);

            // Repair Order
            $device = $_POST['model'];
            $technician_id = $_POST['technician'];
            $issue = $_POST['problem'];
            $status = 'In Progress';
            $image = $uuid;
            $created_on = date('Y-m-d H:i:s');

            $repairOrderModel = new RepairOrder();
            $repairorder_id = $repairOrderModel->addRepair($customer_id, $device, $status, $issue, $technician_id, $image, $created_on);

            $invoiceModel = new Invoice();

            // Invoice
            $price = $_POST['price'];
            $invoice_id = $invoiceModel->addInvoice($price, $repairorder_id); // Pass price and repairorder_id

            if (isset($_POST['parts']) && !empty($_POST['parts'])) {
                $quantity = '1'; 
                $partRepairOrderModel = new Parts_Repairorder();

                foreach ($_POST['parts'] as $partId) {
                    $partRepairOrderModel->addPartsRepairorder($partId, $repairorder_id, $quantity);
                }
            }

            header('Location: /');
            exit();
        }
    }
}