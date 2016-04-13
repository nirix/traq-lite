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
use Unf\Kernel as UnfKernel;
use Unf\AppKernel;
use Unf\Request;
use Avalon\Templating\View;
use Avalon\Templating\Engines\PhpExtended;
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

        // Setup Whoops if we're in development
        if ($_ENV['environment'] == 'development') {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }

        // Make the request class a little easier to access.
        class_alias('Unf\\Request', 'Request');

        // Setup database and templating
        $this->setupDatabaseConnection();
        $this->setupViewEngine();

        // Set current language
        // TODO: allow changing of this via the AdminCP and UserCP
        Language::register('EnglishAu', new EnglishAu);
        Language::setCurrent('EnglishAu');

        require __DIR__ . '/common.php';

        $this->getCurrentUser();
    }

    /**
     * Get the current user.
     */
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

    /**
     * Setup database connection.
     */
    protected function setupDatabaseConnection()
    {
        $dbConfig = $this->config['db'][$this->config['environment']];
        $GLOBALS['db'] = new PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password']);
        $GLOBALS['db']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $GLOBALS['db']->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        define('PREFIX', $dbConfig['prefix']);
        unset($dbConfig);
    }

    /**
     * Setup Avalon templating to use the extended PHP engine.
     */
    protected function setupViewEngine()
    {
        $engine = new PhpExtended;
        $engine->escapeVariables = false;

        View::setEngine($engine);
        View::addPath($this->path . '/views');
    }

    /**
     * Overwrite the `run` method to check admin permissions.
     */
    public function run()
    {
        Request::init();

        if (Request::seg(0) == 'admin' && !currentUser()->isAdmin()) {
            echo show403();
            exit;
        } else {
            return parent::run();
        }
    }
}
