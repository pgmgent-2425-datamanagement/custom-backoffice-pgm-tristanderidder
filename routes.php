<?php

//GET Requests
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');
$router->get('/addRepair', 'addRepairController@index');
$router->get('/repairs', 'RepairsController@index');
$router->get('/parts', 'PartsController@index');
$router->get('/addPart', 'addPartsController@index');

//POST Requests
$router->post('/updateRepairOrder', 'HomeController@updateRepairOrder');
$router->post('/deleteRepairOrder', 'HomeController@deleteRepairOrder');
$router->post('/addRepair', 'addRepairController@addRepair');
$router->post('/addPart', 'addPartsController@addPart');
$router->post('/updatePart', 'PartsController@updatePart');
$router->post('/deletePart', 'PartsController@deletePart');

