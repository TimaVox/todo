<?php
define("DEBUG", 1);
define('ROOT', dirname(__DIR__));

$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", '', $app_path);
$app_path = str_replace('/public/', '', $app_path);
define("PATH", $app_path);

use Todo\App;
use Todo\Router;

require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/config/routes.php';

$app = new App();
