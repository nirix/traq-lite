<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

if (!currentProject()) {
    return show404();
}

return view('projects/show.phtml', ['project' => currentProject()]);
