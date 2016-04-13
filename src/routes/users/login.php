<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

if (Request::$method == 'POST') {
    $query = db()->prepare('SELECT password, session_hash FROM '.PREFIX.'users WHERE username = ? LIMIT 1');
    $query->bindValue(1, Request::$post['username'], PDO::PARAM_STR);
    $query->execute();

    $user = $query->fetch();

    if ($user && password_verify(Request::$post['password'], $user['password'])) {
        setcookie('traq', $user['session_hash'], time() + (60 * 60 * 24 * 7), '/');
        return redirect('/');
    } else {
        return view('users/login.phtml', ['error' => true]);
    }
} else {
    return view('users/login.phtml');
}
