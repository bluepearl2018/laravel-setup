<?php

return [
    'name' => 'Laravel Setup',
    'description' => 'Eutranet\'s Laravel Setup is the 4th core package.',
    'baseline' => 'Software development and internationalization',
    // Tables for the laravel-setup
    'migrations' => [
        'create_agreements_table',
        'create_admins_table',
        'create_docs_table',
        'create_doc_catefgories_table',
        'create_emails_table',
        'create_general_terms_table',
        'create_guards_table',
        'create_menus_table',
        'create_model_docs_table',
        'create_permission_tables', // Spatie
        'create_setup_processes_table',
        'create_setup_steps_table',
        'create_staff_members_table',
    ],
    /*
    |--------------------------------------------------------------------------
    | Tables
    |--------------------------------------------------------------------------
    | Tables - actually table names - are used to generate permissions during the installation.
    | Permissions are LCRUD (list-, create-, read-, update-, delete-, translate-) + slugified table name.
    |
    */
    'tables' => [
        'agreements',
        'admins',
        'docs',
        'doc_categories',
        'emails',
        'general_terms',
        'guards',
        'language_lines',
        'menus',
        'model_docs',
        'permissions',
        'roles',
        'role_has_permissions',
        'setup_processes',
        'setup_steps',
        'staff_members',
    ],
    'models' =>
    [
        'Admin',
        'Agreement',
        'Corporate',
        'Doc',
        'DocCategory',
        'Email',
        'GeneralTerm',
        'Guard',
        'LanguageLine',
        'ModelDoc',
        'Permission',
        'Role',
        'RoleHasPermission',
        'SetupProcess',
        'SetupStep',
        'StaffMember',
        'User'
    ],
    /*
    |--------------------------------------------------------------------------
    | Middlewares
    |--------------------------------------------------------------------------
    |µ
    |
    */
    'middlewares' => array(
        'web',
        'setup-migrated',
        // 'role:super-admin'
    ),
];
