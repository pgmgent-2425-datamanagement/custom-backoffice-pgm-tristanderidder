<?php

namespace App\Controllers;

use App\Models\Technician;

class HomeController extends BaseController {

    public static function index () {

        $technician = Technician::all();

        self::loadView('/home', [
            'title' => 'Homepage',
            'technicians'=> $technician
        ]);
    }

}