<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$milestones = db()->prepare('
    SELECT name, slug, description
    FROM '.PREFIX.'milestones
    WHERE project_id = ?
    ORDER BY display_order
');
$milestones->execute([currentProject()['id']]);
return render('roadmap/index.phtml', ['milestones' => $milestones->fetchAll()]);
