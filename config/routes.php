<?php
Unf\Router::addToken('pslug', '(?<pslug>[^/]+)');

return [
    '/' => 'routes/projects/index.php',

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

    // Ticket types
    '/admin/types' => 'routes/admin/types/index.php',
    '/admin/types/new' => 'routes/admin/types/new.php',
    '/admin/types/{id}/edit' => 'routes/admin/types/edit.php',

    // Ticket statuses
    '/admin/statuses' => 'routes/admin/statuses/index.php',
    '/admin/statuses/new' => 'routes/admin/statuses/new.php',
    '/admin/statuses/{id}/edit' => 'routes/admin/statuses/edit.php',

    // Milestones
    '/admin/milestones' => 'routes/admin/milestones/index.php',
    '/admin/milestones/new' => 'routes/admin/milestones/new.php',
    '/admin/milestones/{id}/edit' => 'routes/admin/milestones/edit.php',

    // Components
    '/admin/components' => 'routes/admin/components/index.php',
    '/admin/components/new' => 'routes/admin/components/new.php',
    '/admin/components/{id}/edit' => 'routes/admin/components/edit.php',

    // Users
    '/admin/users' => 'routes/admin/users/index.php',
    '/admin/users/new' => 'routes/admin/users/new.php',
    '/admin/users/{id}/edit' => 'routes/admin/users/edit.php',

    // -------------------------------------------------------------------------
    // Projects
    '/{pslug}' => 'routes/projects/show.php',

    // Roadmap
    '/{pslug}/roadmap' => 'routes/roadmap/index.php',
    '/{pslug}/roadmap/{slug}' => 'routes/roadmap/show.php',

    // Tickets
    '/{pslug}/tickets' => 'routes/tickets/index.php',
    '/{pslug}/tickets/new' => 'routes/tickets/new.php',
    '/{pslug}/tickets/{id}' => 'routes/tickets/show.php'
];
