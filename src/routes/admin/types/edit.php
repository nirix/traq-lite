<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Type;

$query = db()->prepare('SELECT * FROM '.PREFIX.'types WHERE id = ? LIMIT 1');
$query->bindValue(1, Request::$properties['id']);
$query->execute();

$type = $query->fetch();

if (!$type) {
    return show404();
}

$type = new Type($type);

if (Request::$method == 'POST') {
    $type->set('name', Request::$post['name']);

    if ($type->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('UPDATE '.PREFIX.'types SET name = :name WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $type['id']);
        $query->bindValue(':name', $type['name']);
        $query->execute();

        db()->commit();

        return redirect('/admin/types');
    }
}

return renderAdmin('types/edit.phtml', ['type' => $type]);
