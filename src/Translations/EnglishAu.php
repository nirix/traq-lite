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
        'login'       => 'Login',
        'register'    => 'Register',
        'timeline'    => 'Timeline',
        'tickets'     => 'Tickets',
        'description' => 'Description',
        'edit'        => 'Edit',
        'delete'      => 'Delete',
        'dashboard'   => 'Dashboard',

        // Admin
        'view_site' => 'View Site',

        // Users
        'users'          => 'Users',
        'username'       => 'Username',
        'password'       => 'Password',
        'email'          => 'Email',
        'create_account' => 'Create Account',

        // Projects
        'projects'       => 'Projects',
        'new_project'    => 'New Project',
        'create_project' => 'Create Project',
        'edit_project'   => 'Edit Project',
        'name'           => 'Name',
        'slug'           => 'Slug',

        // Ticket properties
        'id'      => 'ID',
        'summary' => 'Summary',

        // Milestones
        'milestones' => 'Milestones',

        // Help
        'help.slug' => 'The URL friendly version of the project name.',

        // Errors
        'errors.validation.required'  => '{field} is required',
        'errors.validation.minLength' => '{field} must at least {length} characters long',
        'errors.validation.email'     => '{field} is not a valid email address',
        'errors.validation.unique'    => '{field} is already in use',

        'errors.messages_for.header' => 'Please correct the following errors'
    ];
}
