<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Modo de manutenção
if (file_exists($maintenance = __DIR__.'/../dados/laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Autoloader do Composer
require __DIR__.'/../dados/laravel/vendor/autoload.php';

// Bootstrap do Laravel
/** @var Application $app */
$app = require_once __DIR__.'/../dados/laravel/bootstrap/app.php';

$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());