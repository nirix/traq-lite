<?php
Unf\Router::addToken('pslug', '(?<pslug>[^/]+)');

return [
    '/' => 'routes/index.php',

    '/login' => 'routes/users/login.php',
    '/register' => 'routes/users/register.php',

    // -------------------------------------------------------------------------
    // Admin
    '/admin' => 'routes/admin/dashboard.php',
    '/{pslug}' => 'routes/project.php',
    '/{pslug}/tickets' => 'routes/tickets.php',
    '/{pslug}/tickets/{id}' => 'routes/tickets/show.php'
];
