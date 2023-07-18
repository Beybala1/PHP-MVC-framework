<?php

// Load the necessary files and initialize the framework
require_once __DIR__ . '/../core/Router.php';

// Create a new instance of the Router
$router = new Router();

require_once __DIR__ . '/../app/routes/web.php';
require_once __DIR__ . '/../app/routes/api.php';

// Dispatch the request to the appropriate controller and action
$router->dispatch();


