<?php

require __DIR__ . '/vendor/autoload.php';

use Michel\Projeto\App\Application;

$router = require_once __DIR__ . '/web.php';

require_once __DIR__ . '/database.php';

define('CSS_PATH', "Static/css/");
define('IMG_PATH', "Static/img/");

$app = new Application($router);

$app->send();
