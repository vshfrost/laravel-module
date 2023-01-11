<?php 

/*
|------------------------------------------------------------------------------
| Default Module Configurations
|------------------------------------------------------------------------------
|
| There are the module configurations list.
| Can be redefined for every module.
|
*/
return [

    /*
    |--------------------------------------------------------------------------
    | Is Active
    |--------------------------------------------------------------------------
    |
    | This is a bool value.
    | You can enable or disable the module.
    |
    */

    'is_active'   => true,

    /*
    |--------------------------------------------------------------------------
    | Configuration Settings.
    |--------------------------------------------------------------------------
    |
    | This is an array of settings for module configuration.
    |
    */

    'config'      => [

        /*
        |----------------------------------------------------------------------
        | Tree Structure.
        |----------------------------------------------------------------------
        |
        | Do we use tree structure for configuration bindings?
        | If it's 'true' means that structure:
        |
        | first-level-folder
        | | second-level-folder
        | | | second-level-config.php
        | | first-level-config.php
        | zero-level-config.php
        | 
        | Will be binded in:
        | 
        | 'zero-level-config.<key>'
        | 'first-level-folder.first-level-config.<key>'
        | 'first-level-folder.second-level-folder.second-level-config.<key>'
        |
        */

        'tree_structure' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    | Configurations by routes type.
    | By default, type is the same with the route file name.
    | 
    | Fill free to add the routes configurations for every route file
    | in proposed structure.
    | 
    | Generated values will be used for the commented keys or 
    | absent route types.
    |
    */

    'routes'       => [

        /*
        |----------------------------------------------------------------------
        | Web
        |----------------------------------------------------------------------
        |
        | Configurations for web-typed routes. 
        | By default, they have to be placed in web.php.
        |
        */

        'web' => [

            /*
            |------------------------------------------------------------------
            | Middleware
            |------------------------------------------------------------------
            |
            | Base middleware for all routes.
            |
            | If commented will be used generated value by template:
            | <module-name>.web
            |
            */

            // 'middleware' => '',

            /*
            |------------------------------------------------------------------
            | Prefix
            |------------------------------------------------------------------
            |
            | Base prefix for all routes.
            |
            | If commented will be used generated value by template:
            | web/<module-name>
            |
            */

            // 'prefix'     => '',

            /*
            |------------------------------------------------------------------
            | Alias
            |------------------------------------------------------------------
            |
            | Base alias for all routes.
            |
            | If commented will be used generated value by template:
            | web.<module-name>
            |
            */

            // 'alias'      => '',

            /*
            |------------------------------------------------------------------
            | Limit
            |------------------------------------------------------------------
            |
            | Limitation settings.
            | If commented, will be no limitations.
            |
            */

            // 'limit'      => [

                /*
                |--------------------------------------------------------------
                | In
                |--------------------------------------------------------------
                |
                | Period in minutes. 
                |
                */

            //     'in'    => 1, // Minutes decay

                /*
                |--------------------------------------------------------------
                | Count
                |--------------------------------------------------------------
                |
                | Requests count in setted period. 
                |
                */

            //     'count' => 1,
            // ],
        ],
    ],
];
