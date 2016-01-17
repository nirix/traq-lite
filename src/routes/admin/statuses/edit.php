<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Status;

$query = db()->prepare('SELECT * FROM '.PREFIX.'statuses WHERE id = ? LIMIT 1');
$query->bindValue(1, Request::$properties['id']);
$query->execute();

$status = $query->fetch();

if (!$status) {
    return show404();
}

$status = new Status($status);

if (Request::$method == 'POST') {
    $status->set([
        'name'   => Request::$post['name'],
        'status' => Request::$post['status']
    ]);

    if ($status->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('UPDATE '.PREFIX.'statuses SET name = :name, status = :status WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $status['id']);
        $query->bindValue(':name', $status['name']);
        $query->bindValue(':status', $status['status']);
        $query->execute();

        db()->commit();

        return redirect('/admin/statuses');
    }
}

return renderAdmin('statuses/edit.phtml', ['status' => $status]);
