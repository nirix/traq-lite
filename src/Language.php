<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

namespace Traq;

use Exception;

class Language
{
    protected static $current;
    protected static $registered = [];

    public static function setCurrent($locale)
    {
        if (!isset(static::$registered[$locale])) {
            throw new Exception("Locale [{$locale}] is not registered");
        }

        static::$current = static::$registered[$locale];
    }

    public static function register($locale, $translator)
    {
        static::$registered[$locale] = $translator;
    }

    public static function current()
    {
        return static::$current;
    }

    public static function translate($string, $args)
    {
        return static::current()->translate($string, $args);
    }
}
