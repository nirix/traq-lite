<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

$projects = db()->query('SELECT name, slug, description FROM '.PREFIX.'projects');
$projects->execute();
return view('projects/index.phtml', ['projects' => $projects->fetchAll()]);
