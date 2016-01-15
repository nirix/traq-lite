<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$query = db()->query('SELECT * FROM '.PREFIX.'projects ORDER BY display_order ASC');
$query->execute();

return renderAdmin('projects/index.phtml', ['projects' => $query->fetchAll()]);
