<?php
Unf\Router::addToken('pslug', '(?<pslug>[^/]+)');

return [
    '/' => 'routes/index.php',
    '/{pslug}' => 'routes/project.php',
    '/{pslug}/tickets' => 'routes/tickets.php'
];
