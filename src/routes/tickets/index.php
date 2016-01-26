<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$tickets = db()->prepare('
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
    WHERE t.project_id = ?
');
$tickets->execute([currentProject()['id']]);
return render('tickets/index.phtml', ['tickets' => $tickets->fetchAll()]);
