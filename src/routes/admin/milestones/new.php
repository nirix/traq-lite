<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Milestone;

$milestone = new Milestone;

if (Request::$method == 'POST') {
    $milestone->set([
        'name' => Request::$post['name'],
        'slug' => Request::$post['slug'],
        'description' => Request::$post['description'],
        'project_id' => Request::$post['project_id'],
        'display_order' => Request::$post['display_order']
    ]);

    if ($milestone->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('
            INSERT INTO '.PREFIX.'milestones
            (name, slug, description, project_id, display_order, created_at)
            VALUES(:name, :slug, :description, :project_id, :display_order, NOW())
        ');

        $query->bindValue(':name', $milestone['name']);
        $query->bindValue(':slug', $milestone['slug']);
        $query->bindValue(':description', $milestone['description']);
        $query->bindValue(':project_id', $milestone['project_id'], PDO::PARAM_INT);
        $query->bindValue(':display_order', $milestone['display_order'], PDO::PARAM_INT);

        $query->execute();

        db()->commit();

        return redirect('/admin/milestones');
    }
}

return renderAdmin('milestones/new.phtml', ['milestone' => $milestone]);
