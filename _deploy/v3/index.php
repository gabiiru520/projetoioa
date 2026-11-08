<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// IIS da Locaweb sem URL Rewrite: o web.config envia 404/405 para este index.php
// (httpErrors ExecuteURL) com QUERY_STRING = "404;http://host:80/caminho?query".
// Reconstrói a URL original para o Laravel rotear normalmente.
if (isset($_SERVER['QUERY_STRING']) && preg_match('#^40[45];https?://[^/]+(/.*)?$#i', $_SERVER['QUERY_STRING'], $m)) {
    $uri = $m[1] ?? '/';
    $qs = (string) parse_url($uri, PHP_URL_QUERY);
    $_SERVER['REQUEST_URI'] = $uri;
    $_SERVER['QUERY_STRING'] = $qs;
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['PHP_SELF'] = '/index.php';
    unset($_SERVER['PATH_INFO'], $_SERVER['ORIG_PATH_INFO'], $_SERVER['HTTP_X_ORIGINAL_URL'], $_SERVER['UNENCODED_URL']);
    $_GET = [];
    parse_str($qs, $_GET);
}

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