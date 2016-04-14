<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$query = db()->query('
    SELECT u.*, g.name AS group_name
    FROM '.PREFIX.'users u
    LEFT JOIN '.PREFIX.'groups g ON g.id = u.group_id
    ORDER BY username ASC
');
$query->execute();

return view('admin/users/index.phtml', ['users' => $query->fetchAll()]);
