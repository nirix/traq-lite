<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq\Translations;

use Traq\Translation;

class EnglishAu extends Translation
{
    protected static $name = 'English';
    protected static $locale = 'en_AU';
    protected static $strings = [
        'projects' => 'Projects',
        'timeline' => 'Timeline',
        'tickets'  => 'Tickets',

        // Ticket properties
        'id'      => 'ID',
        'summary' => 'Summary',
        // Errors
        'errors.validation.required'  => '{field} is required',
        'errors.validation.minLength' => '{field} must at least {length} characters long',
        'errors.validation.email'     => '{field} is not a valid email address',
    ];
}
