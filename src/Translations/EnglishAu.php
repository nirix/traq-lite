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
        'login'         => 'Login',
        'register'      => 'Register',
        'profile'       => 'Profile',
        'logout'        => 'Logout',
        'timeline'      => 'Timeline',
        'tickets'       => 'Tickets',
        'description'   => 'Description',
        'edit'          => 'Edit',
        'delete'        => 'Delete',
        'dashboard'     => 'Dashboard',
        'display_order' => 'Display order',

        // Admin
        'admincp'   => 'AdminCP',
        'view_site' => 'View Site',
        'settings'  => 'Settings',
        'title'     => 'Title',

        // Users
        'users'          => 'Users',
        'username'       => 'Username',
        'password'       => 'Password',
        'email'          => 'Email',
        'create_account' => 'Create Account',

        // Projects
        'project'        => 'Project',
        'projects'       => 'Projects',
        'new_project'    => 'New Project',
        'edit_project'   => 'Edit Project',
        'name'           => 'Name',
        'slug'           => 'Slug',

        // Ticket properties
        'id'      => 'ID',
        'summary' => 'Summary',
        'body'    => 'Description',

        // Ticket types
        'type'         => 'Type',
        'ticket_types' => 'Ticket Types',
        'new_type'     => 'New Type',
        'edit_type'    => 'Edit Type',

        // Ticket statuses
        'status'          => 'Status',
        'ticket_statuses' => 'Ticket Statuses',
        'new_status'      => 'New Status',
        'edit_status'     => 'Edit Status',
        'open'            => 'Open',
        'closed'          => 'Closed',

        // Milestones
        'milestones'     => 'Milestones',
        'new_milestone'  => 'New Milestone',
        'edit_milestone' => 'Edit Milestone',

        // Components
        'component'      => 'Component',
        'components'     => 'Components',
        'new_component'  => 'New Component',
        'edit_component' => 'Edit Component',

        // Forms
        'create' => 'Create',
        'save'   => 'Save',

        // Help
        'help.slug' => 'A string to be used in the URL.',

        // Confirmations
        'confirm.delete_x' => 'Deleting {0} cannot be undone, are you sure?',

        // Errors
        'errors.validation.required'  => '{field} is required',
        'errors.validation.minLength' => '{field} must at least {length} characters long',
        'errors.validation.email'     => '{field} is not a valid email address',
        'errors.validation.unique'    => '{field} is already in use',

        'errors.messages_for.header' => 'Please correct the following errors'
    ];
}
