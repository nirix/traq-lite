<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Project;

$project = new Project;

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
            INSERT INTO '.PREFIX.'projects
            (name, slug, description, display_order, created_at)
            VALUES(:name, :slug, :description, :display_order, NOW())
        ');

        $query->bindValue(':name', $project['name']);
        $query->bindValue(':slug', $project['slug']);
        $query->bindValue(':description', $project['description']);
        $query->bindValue(':display_order', $project['display_order'], PDO::PARAM_INT);

        $query->execute();

        db()->commit();

        return redirect('/admin/projects');
    }
}

return view('admin/projects/new.phtml', ['project' => $project]);
