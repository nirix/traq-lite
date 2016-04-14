<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq\Models;

class Group extends Model
{
    protected $validations = [
        'name' => ['required']
    ];

    public static function all()
    {
        $query = db()->query('SELECT * FROM '.PREFIX.'groups ORDER BY name ASC');
        $query->execute();
        return $query->fetchAll();
    }
}
