<?php
$autoloader = require __DIR__ . '/vendor/autoload.php';
define('START_TIME', microtime(true));
define('START_MEM', memory_get_usage());

try {
    (new Traq\Kernel)->run();
} catch (Unf\NoRouteFoundException $e) {
    echo show404();
}
