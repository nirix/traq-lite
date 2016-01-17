<?php
Unf\Router::addToken('pslug', '(?<pslug>[^/]+)');

return [
    '/' => 'routes/index.php',

    // -------------------------------------------------------------------------
    // Users
    '/login' => 'routes/users/login.php',
    '/register' => 'routes/users/register.php',

    // -------------------------------------------------------------------------
    // Admin
    '/admin' => 'routes/admin/dashboard.php',
    '/admin/settings' => 'routes/admin/settings.php',

    // Projects
    '/admin/projects' => 'routes/admin/projects/index.php',
    '/admin/projects/new' => 'routes/admin/projects/new.php',
    '/admin/projects/{id}/edit' => 'routes/admin/projects/edit.php',

    // Milestones
    '/admin/milestones' => 'routes/admin/milestones/index.php',
    '/admin/milestones/new' => 'routes/admin/milestones/new.php',
    '/admin/milestones/{id}/edit' => 'routes/admin/milestones/edit.php',

    // Ticket types
    '/admin/types' => 'routes/admin/types/index.php',
    '/admin/types/new' => 'routes/admin/types/new.php',
    '/admin/types/{id}/edit' => 'routes/admin/types/edit.php',

    // -------------------------------------------------------------------------
    // Projects
    '/{pslug}' => 'routes/project.php',
    '/{pslug}/tickets' => 'routes/tickets.php',
    '/{pslug}/tickets/{id}' => 'routes/tickets/show.php'
];
