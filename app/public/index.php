<?php

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

use Serg\Crudapp\App;

(new App())->run();
