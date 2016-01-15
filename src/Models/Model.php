<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq\Models;

use Unf\ParameterBag;

abstract class Model extends ParameterBag
{
    protected $validations = [];
    public $errors = [];

    public function __construct(array $data = [])
    {
        $this->properties = $data;
    }

    // -------------------------------------------------------------------------
    // Errors

    public function addError($field, $error, array $options = [])
    {
        $this->errors[$field][] = $options + [
            'field' => $field,
            'error' => $error
        ];
    }

    public function hasError($field)
    {
        return isset($this->errors[$field]);
    }

    public function getError($field)
    {
        if (isset($this->errors[$field])) {
            return $this->errors[$field][0];
        }
    }

    public function validate()
    {
        foreach ($this->validations as $field => $validations) {
            foreach ($validations as $validation => $options) {
                if (is_numeric($validation)) {
                    $validation = $options;
                    $options = null;
                }

                if ($validation == 'required') {
                    if ($this[$field] === null || empty($this[$field])) {
                        $this->addError($field, 'required');
                    }
                } elseif ($validation == 'email') {
                    if (!filter_var($this['email'], \FILTER_VALIDATE_EMAIL)) {
                        $this->addError($field, 'email');
                    }
                } elseif ($validation == 'minLength') {
                    if (strlen($this[$field]) < $options) {
                        $this->addError($field, 'minLength', ['length' => $options]);
                    }
                }
            }
        }

        return !count($this->errors);
    }
}
