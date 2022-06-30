<?php

/**
 * Controlling the flow of application
 *
 */

/**
 * Composer Autoload file
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

//Load ENV variable form env file
(new Core\EnvParser(dirname(__DIR__). '/.env'))->load();

require dirname(__DIR__) . '/Routing/web.php';