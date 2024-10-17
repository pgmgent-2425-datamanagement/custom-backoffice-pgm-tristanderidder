<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Technician;
use App\Models\RepairOrder;
use App\Models\Device;
use App\Models\Invoice;

class addRepairController extends BaseController
{
    public static function index()
    {
        $technician = new Technician();
        $technicians = $technician->getAllTechnicians();

        $device = new Device();
        $devices = $device->getAllDevices();

        self::loadView('/addRepair', [
            'title' => 'Add Repair',
            'technicians' => $technicians,
            'devices' => $devices
        ]);
    }

    public static function addRepair()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Collect customer data
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];

            // Add customer and get the customer_id
            $customerModel = new Customer();
            $customer_id = $customerModel->addCustomer($firstname, $lastname, $phone);

            // Collect other form data
            $device = $_POST['model'];
            $technician_id = $_POST['technician'];
            $issue = $_POST['problem'];
            $status = 'In Progress';
            $created_on = date('Y-m-d H:i:s');

            // Add the repair order and get the repairorder_id
            $repairOrderModel = new RepairOrder();
            $repairorder_id = $repairOrderModel->addRepair($customer_id, $device, $status, $issue, $technician_id, $created_on);

            // Collect price for the invoice
            $price = $_POST['price'];

            // Add the invoice, ensuring the repairorder_id is passed
            $invoiceModel = new Invoice();
            $invoice_id = $invoiceModel->addInvoice($price, $repairorder_id); // Pass price and repairorder_id

            header('Location: /');
            exit();
        }
    }


}