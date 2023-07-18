<?php

global $router;
$router->get('/api', 'HomeController@index');
$router->get('/api/hi', 'HomeController@hi');
