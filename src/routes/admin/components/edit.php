<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Component;

$query = db()->prepare('SELECT * FROM '.PREFIX.'components WHERE id = ? LIMIT 1');
$query->bindValue(1, Request::$properties['id']);
$query->execute();

$component = $query->fetch();

if (!$component) {
    return show404();
}

$component = new Component($component);

if (Request::$method == 'POST') {
    $component->set([
        'name' => Request::$post['name'],
        'slug' => Request::$post['slug'],
        'description' => Request::$post['description'],
        'display_order' => Request::$post['display_order']
    ]);

    if ($component->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('UPDATE '.PREFIX.'components SET name = :name WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $component['id'], PDO::PARAM_INT);
        $query->bindValue(':name', $component['name']);
        $query->execute();

        db()->commit();

        return redirect('/admin/components');
    }
}

return renderAdmin('components/edit.phtml', ['component' => $component]);
