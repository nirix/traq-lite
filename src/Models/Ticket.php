<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq\Models;

class Ticket extends Model
{
    protected $validations = [
        'summary'      => ['required'],
        'body'         => ['required'],
        'milestone_id' => ['required'],
        'user_id'      => ['required'],
        'type_id'      => ['required'],
        'status_id'    => ['required']
    ];
}
