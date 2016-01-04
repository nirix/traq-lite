<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Unf\View;
use Unf\Request;

// -----------------------------------------------------------------------------
// Database

function db()
{
    return $GLOBALS['db'];
}

// -----------------------------------------------------------------------------
// Projects

function currentProject()
{
    $project = db()->prepare('SELECT * FROM '.PREFIX.'projects WHERE slug = ? LIMIT 1');
    return $project->execute([Request::$properties->get('pslug')]) ? $project->fetch() : false;
}

// -----------------------------------------------------------------------------
// URLs

function baseUrl($append = null)
{
    return Request::$basePath . rtrim('/' . ltrim($append, '/'), '/');
}

function projectUrl($append = null)
{
    return baseUrl(currentProject()['slug']) . rtrim('/' . ltrim($append, '/'), '/');
}

// -----------------------------------------------------------------------------
// Views

function show404()
{
    return render('errors/404.phtml');
}

function render($view, array $locals = [])
{
    $locals = $locals + [
        '_layout' => 'default.phtml'
    ];

    return view("layouts/{$locals['_layout']}", ['content' => view($view, $locals)]);
}

function view($view, array $locals = [])
{
    return View::render($view, $locals);
}

function e($string)
{
    return htmlspecialchars($string);
}

// -----------------------------------------------------------------------------
// Misc.

function iif($cond, $true, $false = null)
{
    return $cond ? $true : $false;
}

function dd()
{
    call_user_func_array('var_dump', func_get_args());
    exit;
}
