<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Unf\Request;
use Avalon\Templating\View;
use Traq\Language;
use Traq\Models\Model;
use Traq\Models\User;
use Traq\Models\Project;

// -----------------------------------------------------------------------------
// Settings

/**
 * @param string $name
 *
 * @return string
 */
function setting($name)
{
    static $settings;

    if (!$settings) {
        $query = db()->query('SELECT name, value FROM '.PREFIX.'settings');
        $query->execute();

        foreach ($query->fetchAll() as $setting) {
            $settings[$setting['name']] = $setting['value'];
        }
    }

    return $settings[$name];
}

// -----------------------------------------------------------------------------
// Translations

/**
 * @param string $string
 * @param array  $args
 *
 * @return string
 */
function t($string, $args = [])
{
    return Language::translate($string, $args);
}

// -----------------------------------------------------------------------------
// Database

/**
 * @return PDO
 */
function db()
{
    return $GLOBALS['db'];
}

// -----------------------------------------------------------------------------
// Users

/**
 * @return User
 */
function currentUser()
{
    return isset($GLOBALS['current_user']) ? $GLOBALS['current_user'] : false;
}

// -----------------------------------------------------------------------------
// Projects

/**
 * @return array
 */
function currentProject()
{
    if (!isset($_GLOBALS['current_project'])) {
        $query = db()->prepare('SELECT * FROM '.PREFIX.'projects WHERE slug = ? LIMIT 1');
        $query->bindValue(1, Request::$properties->get('pslug'));
        $query->execute();

        $project = $query->fetch();

        if ($project) {
            $_GLOBALS['current_project'] = new Project($project);
        }
    }

    return isset($_GLOBALS['current_project']) ? $_GLOBALS['current_project'] : false;
}

// -----------------------------------------------------------------------------
// URLs

/**
 * @param string $append
 *
 * @return string
 */
function baseUrl($append = null)
{
    return Request::$basePath . rtrim('/' . ltrim($append, '/'), '/');
}

/**
 * @param string $append
 *
 * @return string
 */
function projectUrl($append = null)
{
    return baseUrl(currentProject()['slug']) . rtrim('/' . ltrim($append, '/'), '/');
}

/**
 * @param string $path
 */
function redirect($path)
{
    header('Location: ' . baseUrl($path));
    exit;
}

// -----------------------------------------------------------------------------
// Errors

/**
 * @param Model $model
 *
 * @return string
 */
function errorMessagesFor(Model $model)
{
    if (!count($model->errors)) {
        return;
    }

    $messages = [];

    foreach ($model->errors as $field => $errors) {
        foreach ($errors as $error) {
            $error['field'] = t($error['field']);
            $messages[] = t('errors.validation.' . $error['error'], $error);
        }
    }

    return view('errors/_messages_for.phtml', ['messages' => $messages]);
}

/**
 * @param Model  $model
 * @param string $field
 *
 * @return string
 */
function errorMessageFor(Model $model, $field)
{
    if (!$model->hasError($field)) {
        return;
    }

    $error = $model->getError($field);
    $error['field'] = t($error['field']);
    return t('errors.validation.' . $error['error'], $error);
}

// -----------------------------------------------------------------------------
// Views

/**
 * @return string
 */
function show404()
{
    return view('errors/404.phtml');
}

/**
 * @return string
 */
function show403()
{
    return view('errors/403.phtml');
}

/**
 * @param string $view
 * @param array  $locals
 *
 * @return string
 */
function view($view, array $locals = [])
{
    return View::render($view, $locals);
}

/**
 * Escape HTML.
 *
 * @param string $string
 *
 * @return string
 */
function e($string)
{
    return htmlspecialchars($string);
}

/**
 * Markdown rendering.
 *
 * @param string $string
 *
 * @return string
 */
function markdown($string)
{
    static $parser;

    if (!$parser) {
        $parser = new ParsedownExtra;
    }

    return $parser->parse($string);
}

// -----------------------------------------------------------------------------
// Misc.

/**
 * @param boolean $cond
 * @param mixed   $true
 * @param mixed   $false
 *
 * @return mixed
 */
function iif($cond, $true, $false = null)
{
    return $cond ? $true : $false;
}

function dd()
{
    call_user_func_array('var_dump', func_get_args());
    exit;
}
