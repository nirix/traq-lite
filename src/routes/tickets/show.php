<?php
$ticket = db()->prepare('
    SELECT
        t.*,
        u.username AS user_username,
        s.name AS status_name,
        tp.name AS type_name,
        m.name AS milestone_name,
        m.slug AS milestone_slug,
        c.name AS component_name
    FROM '.PREFIX.'tickets t
    LEFT JOIN '.PREFIX.'users u ON u.id = t.user_id
    LEFT JOIN '.PREFIX.'statuses s ON s.id = t.status_id
    LEFT JOIN '.PREFIX.'types tp ON tp.id = t.type_id
    LEFT JOIN '.PREFIX.'milestones m ON m.id = t.milestone_id
    LEFT JOIN '.PREFIX.'components c ON c.id = t.component_id
    WHERE t.ticket_id = ?
    AND t.project_id = ?
    LIMIT 1
');
$ticket->bindValue(1, Request::$properties->get('id'), PDO::PARAM_INT);
$ticket->bindValue(2, currentProject()['id'], PDO::PARAM_INT);
$ticket->execute();
return view('tickets/show.phtml', ['ticket' => $ticket->fetch()]);
