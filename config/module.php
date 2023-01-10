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
        */

        'tree_structure' => true,
    ],
];
