<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Milestone;

$query = db()->prepare('SELECT * FROM '.PREFIX.'milestones WHERE id = ? LIMIT 1');
$query->bindValue(1, Request::$properties['id']);
$query->execute();

$milestone = $query->fetch();

if (!$milestone) {
    return show404();
}

$milestone = new Milestone($milestone);

if (Request::$method == 'POST') {
    $milestone->set([
        'name' => Request::$post['name'],
        'slug' => Request::$post['slug'],
        'description' => Request::$post['description'],
        'display_order' => Request::$post['display_order']
    ]);

    if ($milestone->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('
            UPDATE '.PREFIX.'milestones
            SET name = :name,
                slug = :slug,
                description = :description,
                display_order = :display_order,
                updated_at = NOW()
            WHERE id = :id
            LIMIT 1
        ');

        $query->bindValue(':id', $milestone['id'], PDO::PARAM_INT);
        $query->bindValue(':name', $milestone['name']);
        $query->bindValue(':slug', $milestone['slug']);
        $query->bindValue(':description', $milestone['description']);
        $query->bindValue(':display_order', $milestone['display_order'], PDO::PARAM_INT);

        $query->execute();

        db()->commit();

        return redirect('/admin/milestones');
    }
}

return view('admin/milestones/edit.phtml', ['milestone' => $milestone]);
