<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq\Models;

class Component extends Model
{
    protected $validations = [
        'name' => ['required'],
        'project_id' => ['required']
    ];

    // -------------------------------------------------------------------------
    // Validation

    public function validate()
    {
        // Unique
        if (!$this['id']) {
            $query = db()->prepare('SELECT id FROM '.PREFIX.'components WHERE project_id = ? AND name = ? LIMIT 1');
            $query->bindValue(1, $this['project_id'], \PDO::PARAM_STR);
            $query->bindValue(2, $this['name'], \PDO::PARAM_STR);
            $query->execute();

            $result = $query->fetch();

            if ($result && $result['id'] != $this['id']) {
                $this->addError('name', 'unique');
            }
        }

        return parent::validate();
    }
}
