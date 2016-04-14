<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\User;

$query = db()->prepare('SELECT * FROM '.PREFIX.'users WHERE id = ? LIMIT 1');
$query->bindValue(1, Request::$properties['id']);
$query->execute();

$user = $query->fetch();

if (!$user) {
    return show404();
}

$user = new User($user);

if (Request::$method == 'POST') {
    $user->set([
        'name'     => Request::$post['name'],
        'username' => Request::$post['username'],
        'email'    => Request::$post['email'],
        'group_id' => Request::$post['group_id']
    ]);

    if ($user->validate()) {
        db()->beginTransaction();

        $query = db()->prepare("
            UPDATE ".PREFIX."users
            SET name = :name,
                username = :username,
                email = :email,
                group_id = :group_id
            WHERE id = :id
            LIMIT 1
        ");

        $query->bindValue(':id', $user['id'], PDO::PARAM_INT);
        $query->bindValue(':name', $user['name'], PDO::PARAM_STR);
        $query->bindValue(':username', $user['username'], PDO::PARAM_STR);
        $query->bindValue(':email', $user['email'], PDO::PARAM_STR);
        $query->bindValue(':group_id', $user['group_id'], PDO::PARAM_INT);

        $query->execute();

        db()->commit();

        return redirect('/admin/users');
    }
}

return view('admin/users/edit.phtml', ['user' => $user]);
