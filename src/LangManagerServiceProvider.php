<?php

namespace Riadh\LaravelLangManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class LangManagerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Charger le fichier de configuration dans la clé 'lang-manager'
        $this->mergeConfigFrom(__DIR__ . '/../config/lang-manager.php', 'lang-manager');
    }

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Charger les vues fournies par le package
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'lang-manager');

        // Charger les routes fournies par le package
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Publier le fichier de configuration pour que l’utilisateur puisse le personnaliser
        $this->publishes([
            __DIR__ . '/../config/lang-manager.php' => config_path('lang-manager.php'),
        ], 'config');

        // Publier les vues pour permettre à l’utilisateur de les personnaliser
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/lang-manager'),
        ], 'views');

        // Enregistrer les commandes artisan si l'application est exécutée dans la console
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Riadh\LaravelLangManager\Console\Commands\MakeTranslationFile::class,
            ]);
        }

        // Créer automatiquement le dossier `resources/lang` s’il n’existe pas
        if (!is_dir(resource_path('lang'))) {
            mkdir(resource_path('lang'), 0755, true);
        }

        // Log pour confirmer que le ServiceProvider a été chargé
        Log::info('LangManagerServiceProvider loaded successfully.');
    }
}
