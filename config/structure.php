<?php 

/*
|------------------------------------------------------------------------------
| Module Structure Configurations
|------------------------------------------------------------------------------
|
| There are the module structure configurations list.
| Every module must have this structure.
| Can be redefined for all modules at once.
|
*/
return [

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | Every module must contain this structure.
    | Means that:
    |
    | <all_modules_root>
    | | Module
    | | | <module_source_code>
    | | | <module_configuration_files> 
    | | | <module_database_migrations>
    | | | <module_database_seeders>
    | | | <module_translation_files>
    | | | <module_routes_files>
    | | Another_Module
    | | | ...
    |
    */

    'path'        => [

        /*
        |----------------------------------------------------------------------
        | Root
        |----------------------------------------------------------------------
        |
        | All modules root.
        |
        */

        'root'      => 'modules/',

        /*
        |----------------------------------------------------------------------
        | Source
        |----------------------------------------------------------------------
        |
        | Path to the module source code from module root.
        |
        */

        'source'    => 'app/',

        /*
        |----------------------------------------------------------------------
        | Config
        |----------------------------------------------------------------------
        |
        | Path to the module configuration files from module root.
        |
        */

        'config'    => 'config/',

        /*
        |----------------------------------------------------------------------
        | Database
        |----------------------------------------------------------------------
        |
        | Pathes to the module database files.
        |
        */

        'database'  => [

            /*
            |------------------------------------------------------------------
            | Migrations
            |------------------------------------------------------------------
            |
            | Path to the module database migrations from module root.
            |
            */

            'migrations' => 'database/migrations/',

            /*
            |------------------------------------------------------------------
            | Seeds
            |------------------------------------------------------------------
            |
            | Path to the module database seeders from module root.
            |
            */

            'seeds'      => 'database/seeds/',
        ],

        /*
        |----------------------------------------------------------------------
        | Resources
        |----------------------------------------------------------------------
        |
        | Pathes to the module resources files.
        |
        */

        'resources' => [

            /*
            |------------------------------------------------------------------
            | Lang
            |------------------------------------------------------------------
            |
            | Path to the module translation files from module root.
            |
            */

            'lang' => 'resources/lang/',
        ],

        /*
        |----------------------------------------------------------------------
        | Routes
        |----------------------------------------------------------------------
        |
        | Path to the module routes files from module root.
        |
        */
        'routes'    => 'routes/',
    ],

    /*
    |--------------------------------------------------------------------------
    | Config
    |--------------------------------------------------------------------------
    |
    | Special structure for configurations.
    |
    */

    'config'      => [

        /*
        |----------------------------------------------------------------------
        | Delimeter
        |----------------------------------------------------------------------
        |
        | Delimeter between module name and config value path.
        | Means that:
        | config('Module<delimeter>config.<key>')
        |
        */

        'delimeter' => '::',
    ],
];
