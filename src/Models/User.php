<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq\Models;

class User extends Model
{
    protected $validations = [
        'username' => ['required', 'minLength' => 4],
        'password' => ['required', 'minLength' => 6],
        'email'    => ['required', 'email']
    ];

    // -------------------------------------------------------------------------
    // Permissions

    public function isAdmin()
    {
        return $this['is_admin'] == '1' ? true : false;
    }

    // -------------------------------------------------------------------------
    // Validation

    public function validate()
    {
        // Unique
        $query = db()->prepare('SELECT id FROM '.PREFIX.'users WHERE username = ? LIMIT 1');
        $query->bindValue(1, $this['username'], \PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if ($result && $result['id'] != $this['id']) {
            $this->addError('username', 'unique');
        }

        return parent::validate();
    }
}
