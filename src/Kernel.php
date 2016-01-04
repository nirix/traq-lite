<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq;

use PDO;
use Unf\AppKernel;

class Kernel extends AppKernel
{
    const VERSION     = '0.1.0';
    const DB_VERSION  = 00100;
    const API_VERSION = 00100;

    public function __construct()
    {
        parent::__construct();

        $_ENV['environment'] = $this->config['environment'];

        class_alias('Unf\\Request', 'Request');

        $dbConfig = $this->config['db'][$this->config['environment']];
        $GLOBALS['db'] = new PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password']);
        $GLOBALS['db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        define('PREFIX', $dbConfig['prefix']);
        unset($dbConfig);

        require __DIR__ . '/common.php';
    }
}
