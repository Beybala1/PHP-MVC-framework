<?php

global $router;
$router->get('/', 'HomeController@index');
$router->get('/user', 'UserController@index');
$router->get('/user/create', 'UserController@create_redirect');
$router->post('/user/store', 'UserController@store');
$router->get('/user/{id}', 'UserController@show');
$router->get('/user/{id}/edit', 'UserController@edit');
$router->post('/user/{id}/update', 'UserController@updateData');
$router->get('/user/{id}/delete', 'UserController@destroy');



