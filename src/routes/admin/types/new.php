<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Type;

$type = new Type;

if (Request::$method == 'POST') {
    $type->set('name', Request::$post['name']);

    if ($type->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('INSERT INTO '.PREFIX.'types (name) VALUES(:name)');
        $query->bindValue(':name', $type['name']);
        $query->execute();

        db()->commit();

        return redirect('/admin/types');
    }
}

return view('admin/types/new.phtml', ['type' => $type]);
