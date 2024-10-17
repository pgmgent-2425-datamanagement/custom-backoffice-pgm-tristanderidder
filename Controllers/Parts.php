<?php

namespace App\Controllers;

use App\Models\Part;

class PartsController extends BaseController
{
    public static function index()
    {
        $part = new Part();
        $parts = $part->getAllParts();

        self::loadView('/parts', [
            'title' => 'Parts',
            'parts' => $parts
        ]);
    }
}