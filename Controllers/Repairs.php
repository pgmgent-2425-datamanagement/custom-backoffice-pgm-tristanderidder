<?php

namespace App\Controllers;

use App\Models\RepairOrder;

class RepairsController extends BaseController
{
    public static function index()
    {
        $month = isset($_GET['month']) ? $_GET['month'] : date('Y-m'); // Use full 'Y-m' format

        $repairOrderModel = new RepairOrder();

        // Get all repair orders with details for the selected month
        $repairOrders = $repairOrderModel->getAllRepairOrdersWithDataMonthly($month);

        // Get repair data for the selected month for the chart
        $repairDataForMonth = $repairOrderModel->getRepairsForMonth($month);

        self::loadView('/repairs', [
            'title' => 'Repairs',
            'repairOrders' => $repairOrders,
            'repairDataForMonth' => $repairDataForMonth,  // Data for the chart
        ]);
    }
}
