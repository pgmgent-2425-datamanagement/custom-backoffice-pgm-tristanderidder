<?php

namespace App\Controllers;

use App\Models\RepairOrder;

class RepairsController extends BaseController
{
   /**
    * The index function retrieves repair orders and repair data for a specific month and loads a view
    * with the data for display.
    */
    public static function index()
    {
        $month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

        $repairOrderModel = new RepairOrder();

        $repairOrders = $repairOrderModel->getAllRepairOrdersWithDataMonthly($month);

        $repairDataForMonth = $repairOrderModel->getRepairsForMonth($month);

        self::loadView('/repairs', [
            'title' => 'Repairs',
            'repairOrders' => $repairOrders,
            'repairDataForMonth' => $repairDataForMonth,
        ]);
    }
}
