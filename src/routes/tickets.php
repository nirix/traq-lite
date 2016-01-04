<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$tickets = db()->prepare('SELECT * FROM '.PREFIX.'tickets WHERE project_id = ?');
$tickets->execute([currentProject()['id']]);
return render('tickets/show.phtml', ['tickets' => $tickets->fetchAll()]);
