<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Component;

$component = new Component;

if (Request::$method == 'POST') {
    $component->set([
        'name' => Request::$post['name'],
        'project_id' => Request::$post['project_id']
    ]);

    if ($component->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('INSERT INTO '.PREFIX.'components (name, project_id) VALUES(:name, :project_id)');
        $query->bindValue(':name', $component['name']);
        $query->bindValue(':project_id', $component['project_id'], PDO::PARAM_INT);
        $query->execute();

        db()->commit();

        return redirect('/admin/components');
    }
}

return renderAdmin('components/new.phtml', ['component' => $component]);
