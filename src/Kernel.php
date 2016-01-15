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
use Traq\Language;
use Traq\Models\User;
use Traq\Translations\EnglishAu;

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
        $GLOBALS['db']->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        define('PREFIX', $dbConfig['prefix']);
        unset($dbConfig);

        Language::register('EnglishAu', new EnglishAu);
        Language::setCurrent('EnglishAu');

        require __DIR__ . '/common.php';

        $this->getCurrentUser();
    }

    protected function getCurrentUser()
    {
        if (isset($_COOKIE['traq'])) {
            $query = $GLOBALS['db']->prepare('
                SELECT u.*, g.is_admin, g.permissions
                FROM '.PREFIX.'users u
                LEFT JOIN '.PREFIX.'groups g ON g.id = u.group_id
                WHERE session_hash = ? LIMIT 1
            ');

            $query->bindValue(1, $_COOKIE['traq']);
            $query->execute();

            $user = $query->fetch();

            if ($user) {
                $GLOBALS['current_user'] = new User($user);
            }
        }
    }
}
