<?php

//GET Requests
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');
$router->get('/addRepair', 'addRepairController@index');
$router->get('/repairs', 'RepairsController@index');


//POST Requests
$router->post('/updateRepairOrder', 'HomeController@updateRepairOrder');
$router->post('/addRepair', 'addRepairController@addRepair');
