<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

if (Request::$method == 'POST') {
    db()->beginTransaction();

    foreach (Request::$post['settings'] as $name => $value) {
        $query = db()->prepare('UPDATE '.PREFIX.'settings SET value = ? WHERE name = ? LIMIT 1');
        $query->bindValue(1, $value);
        $query->bindValue(2, $name);
        $query->execute();
    }

    db()->commit();

    return redirect('/admin/settings');
}

return view('admin/settings/index.phtml');
