<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\User;

if (Request::$method == 'POST') {
    $user = new User([
        'username' => Request::$post['username'],
        'password' => Request::$post['password'],
        'email'    => Request::$post['email']
    ]);

    if ($user->validate()) {
        $query = db()->prepare('
            INSERT INTO '.PREFIX.'users
            (username, password, email, session_hash, created_at)
            VALUES(:username, :password, :email, :session_hash, NOW())
        ');

        $query->bindValue(':username', $user['username'], PDO::PARAM_STR);
        $query->bindValue(':password', password_hash($user['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $query->bindValue(':email', $user['email'], PDO::PARAM_STR);
        $query->bindValue(':session_hash', sha1(microtime() . time() . rand(0, 500)), PDO::PARAM_STR);

        $query->execute();

        return redirect('/login');
    } else {
        return view('users/register.phtml', ['user' => $user]);
    }
} else {
    return view('users/register.phtml', ['user' => new User]);
}
