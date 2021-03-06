<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$query = db()->query('
    SELECT m.*, p.name AS project_name, p.slug AS project_slug FROM '.PREFIX.'milestones m
    LEFT JOIN '.PREFIX.'projects p ON p.id = m.project_id
    ORDER BY project_name, display_order ASC
');
$query->execute();

return view('admin/milestones/index.phtml', ['milestones' => $query->fetchAll()]);
