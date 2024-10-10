<?php

namespace App\Controllers;

use App\Models\Repairorder;

class HomeController extends BaseController
{

    public static function index()
    {
        // Create an instance of Repairorder
        $repairOrder = new Repairorder();

        // Call the totalRepairs method
        $totalrepairs = $repairOrder->totalRepairs();

        self::loadView('/home', [
            'title' => 'Homepage',
            'totalrepairs' => $totalrepairs
        ]);
    }
}
