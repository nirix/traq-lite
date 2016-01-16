<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq\Models;

class Project extends Model
{
    protected $validations = [
        'name' => ['required'],
        'slug' => ['required'],
    ];

    public static function all()
    {
        $query = db()->query('SELECT * FROM '.PREFIX.'projects ORDER BY display_order ASC');
        $query->execute();

        return $query->fetchAll();
    }

    // -------------------------------------------------------------------------
    // Validation

    public function validate()
    {
        // Unique
        $query = db()->prepare('SELECT id FROM '.PREFIX.'projects WHERE slug = ? LIMIT 1');
        $query->bindValue(1, $this['slug'], \PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch();

        if ($result && $result['id'] != $this['id']) {
            $this->addError('slug', 'unique');
        }

        return parent::validate();
    }
}
