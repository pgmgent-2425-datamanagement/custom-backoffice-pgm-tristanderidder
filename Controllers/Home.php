<?php

namespace App\Controllers;

use App\Models\Repairorder;

class HomeController extends BaseController
{

    public static function index() {
    $repairOrderModel = new RepairOrder();

    // Get total number of completed repairs
    $totalRepairs = $repairOrderModel->totalRepairs();
    
    // Get all repair orders with details
    $repairOrders = $repairOrderModel->getAllRepairOrdersWithData();

    // Check if repairs exist
    error_log("Total Repairs: " . $totalRepairs);
    error_log("Repair Orders Count: " . count($repairOrders));

    self::loadView('/home', [
        'title' => 'Homepage',
        'totalRepairs' => $totalRepairs,
        'repairOrders' => $repairOrders
    ]);
}

}
