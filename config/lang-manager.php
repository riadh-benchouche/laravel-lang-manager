<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lang Manager Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration allows you to customize the behavior of the package.
    | You can define supported languages, included files, and other settings.
    |
    */

    // List of supported locales by default
    'locales' => ['en', 'fr'],

    // Enable or disable dynamic translations
    'dynamic_translations' => true,

    // Path to the language files directory
    'lang_path' => resource_path('lang'),

    // Route prefix for the package
    'route_prefix' => 'lang-manager',

];
