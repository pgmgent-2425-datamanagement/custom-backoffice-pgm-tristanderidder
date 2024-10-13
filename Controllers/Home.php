<?php

namespace App\Controllers;

use App\Models\Repairorder;
use App\Models\Invoice;

class HomeController extends BaseController
{

    public static function index() {
    $repairOrderModel = new RepairOrder();
    $invoiceModel = new Invoice();

    // Get total number of completed repairs
    $totalRepairsToday = $repairOrderModel->totalRepairsToday();
    
    // Get all repair orders with details
    $repairOrders = $repairOrderModel->getAllRepairOrdersWithData();

    // Get All Invoices
    $totalInvoices = $invoiceModel->totalInvoices();

    // Check if repairs exist
    error_log("Total Repairs: " . $totalRepairsToday);
    error_log("Repair Orders Count: " . count($repairOrders));
    error_log('Total Invoices: ' . $totalInvoices);

    self::loadView('/home', [
        'title' => 'Homepage',
        'totalRepairsToday' => $totalRepairsToday,
        'repairOrders' => $repairOrders,
        'totalInvoices' => $totalInvoices
    ]);
}

}
