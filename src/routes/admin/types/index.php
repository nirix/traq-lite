<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$query = db()->query('SELECT * FROM '.PREFIX.'types ORDER BY name ASC');
$query->execute();

return renderAdmin('types/index.phtml', ['types' => $query->fetchAll()]);
