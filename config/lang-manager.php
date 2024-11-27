<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lang Manager Configuration
    |--------------------------------------------------------------------------
    |
    | Cette configuration permet de personnaliser le comportement du package.
    | Vous pouvez définir les langues supportées, les fichiers à inclure, et plus encore.
    |
    */

    // Liste des langues supportées par défaut
    'locales' => ['en', 'fr'],

    // Activer ou désactiver les traductions dynamiques
    'dynamic_translations' => true,

    // Chemin vers le dossier des fichiers de langue
    'lang_path' => resource_path('lang'),

    // Préfixe de la route du package
    'route_prefix' => 'lang-manager',

];
