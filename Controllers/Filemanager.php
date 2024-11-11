<?php

namespace App\Controllers;

class FilemanagerController extends BaseController{

    /**
     * The index function retrieves a list of files in a specified folder and loads a view with the
     * file list.
     * 
     * @param `index` function is a static method that takes an optional parameter
     * ``. This parameter is used to specify the folder within the `/public/images/` directory
     * that you want to list the contents of. If no folder is provided, it will default to listing the
     * contents of the root directory `/
     */
    public static function index($folder = ''){

        $list = scandir(BASE_DIR . "/public/images/" . $folder);

        self::loadView('filemanager/list', [
            'title' => 'File Manager',
            'list' => $list
        ]);
    }
}