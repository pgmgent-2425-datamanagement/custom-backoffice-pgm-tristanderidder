<?php

//$router->get('/', function() { echo 'Dit is de index vanuit de route'; });
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');

// Define the route for updating a repair order (POST request)
$router->post('/updateRepairOrder', 'HomeController@updateRepairOrder');