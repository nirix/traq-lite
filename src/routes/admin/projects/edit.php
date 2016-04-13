<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Project;

$query = db()->prepare('SELECT * FROM '.PREFIX.'projects WHERE id = ? LIMIT 1');
$query->bindValue(1, Request::$properties['id']);
$query->execute();

$project = $query->fetch();

if (!$project) {
    return show404();
}

$project = new Project($project);

if (Request::$method == 'POST') {
    $project->set([
        'name' => Request::$post['name'],
        'slug' => Request::$post['slug'],
        'description' => Request::$post['description'],
        'display_order' => Request::$post['display_order']
    ]);

    if ($project->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('
            UPDATE '.PREFIX.'projects
            SET name = :name,
                slug = :slug,
                description = :description,
                display_order = :display_order,
                updated_at = NOW()
            WHERE id = :id
            LIMIT 1
        ');

        $query->bindValue(':id', $project['id']);
        $query->bindValue(':name', $project['name']);
        $query->bindValue(':slug', $project['slug']);
        $query->bindValue(':description', $project['description']);
        $query->bindValue(':display_order', $project['display_order'], PDO::PARAM_INT);

        $query->execute();

        db()->commit();

        return redirect('/admin/projects');
    }
}

return view('admin/projects/edit.phtml', ['project' => $project]);
