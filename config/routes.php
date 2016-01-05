<?php
Unf\Router::addToken('pslug', '(?<pslug>[^/]+)');

return [
    '/' => 'routes/index.php',

    '/register' => 'routes/users/register.php',

    '/{pslug}' => 'routes/project.php',
    '/{pslug}/tickets' => 'routes/tickets.php',
    '/{pslug}/tickets/{id}' => 'routes/tickets/show.php'
];
