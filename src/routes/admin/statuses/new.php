<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Status;

$status = new Status;

if (Request::$method == 'POST') {
    $status->set([
        'name'   => Request::$post['name'],
        'status' => Request::$post['status']
    ]);

    if ($status->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('INSERT INTO '.PREFIX.'statuses (name, status) VALUES(:name, :status)');
        $query->bindValue(':name', $status['name']);
        $query->bindValue(':status', $status['status']);
        $query->execute();

        db()->commit();

        return redirect('/admin/statuses');
    }
}

return view('admin/statuses/new.phtml', ['status' => $status]);
