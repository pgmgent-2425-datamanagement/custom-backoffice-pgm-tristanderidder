<?php

namespace App\Controllers;

class FilemanagerController extends BaseController{

    public static function index($folder = ''){

        $list = scandir(BASE_DIR . "/public/images/" . $folder);

        self::loadView('filemanager/list', [
            'title' => 'File Manager',
            'list' => $list
        ]);
    }
}