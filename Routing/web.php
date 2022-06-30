<?php

/**
 * Routes of applications added here
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('domain/submit', ['controller' => 'Home', 'action' => 'submitURL']);
$router->add('report', ['controller' => 'Home', 'action' => 'report']);


    
$router->dispatch($_SERVER['QUERY_STRING']);