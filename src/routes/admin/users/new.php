<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\User;

$user = new User;

if (Request::$method == 'POST') {
    $user = new User([
        'name'     => Request::$post['name'],
        'username' => Request::$post['username'],
        'password' => Request::$post['password'],
        'email'    => Request::$post['email'],
        'group_id' => Request::$post['group_id']
    ]);

    if ($user->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('
            INSERT INTO '.PREFIX.'users
            (name, username, password, email, group_id, session_hash, created_at)
            VALUES(:name, :username, :password, :email, :group_id, :session_hash, NOW())
        ');

        $query->bindValue(':name', $user['name'], PDO::PARAM_STR);
        $query->bindValue(':username', $user['username'], PDO::PARAM_STR);
        $query->bindValue(':password', password_hash($user['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $query->bindValue(':email', $user['email'], PDO::PARAM_STR);
        $query->bindValue(':group_id', $user['group_id'], PDO::PARAM_INT);
        $query->bindValue(':session_hash', sha1(microtime() . time() . rand(0, 500)), PDO::PARAM_STR);

        $query->execute();

        db()->commit();

        return redirect('/admin/users');
    }
}

return view('admin/users/new.phtml', ['user' => $user]);
