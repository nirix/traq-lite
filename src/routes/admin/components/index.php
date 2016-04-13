<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$query = db()->query('
    SELECT c.*, p.name AS project_name, p.slug AS project_slug FROM '.PREFIX.'components c
    LEFT JOIN '.PREFIX.'projects p ON p.id = c.project_id
    ORDER BY project_name, name ASC
');
$query->execute();

return view('admin/components/index.phtml', ['components' => $query->fetchAll()]);
