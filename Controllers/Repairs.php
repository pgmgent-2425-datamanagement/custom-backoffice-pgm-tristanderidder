<?php

namespace App\Controllers;

use App\Models\RepairOrder;

class RepairsController extends BaseController
{
    public static function index()
    {
        $month = isset($_GET['month']) ? (int)$_GET['month'] : date('m'); // Ensure it's an integer

        $repairOrderModel = new RepairOrder();

        // Get all repair orders with details
        $repairOrders = $repairOrderModel->getAllRepairOrdersWithDataMontly($month);

        self::loadView('/repairs', [
            'title' => 'Repairs',
            'repairOrders' => $repairOrders,
        ]);
    }
}