<?php

namespace Riadh\LaravelLangManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class LangManagerServiceProvider extends ServiceProvider
{
    /**
     * @title : Register the application services.
     * @description : Merges the package's configuration file into the application's 'lang-manager' key.
     * @return void
     */
    public function register(): void
    {
        // Merge the package's configuration file into the application's configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/lang-manager.php', 'lang-manager');
    }

    /**
     * @title : Boot the application services.
     * @description : Loads views, routes, publishes configuration, and sets up assets and commands.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load the views provided by the package, accessible via the 'lang-manager::' namespace
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'lang-manager');

        // Load the routes provided by the package
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Publish the configuration file, allowing users to customize it
        $this->publishes([
            __DIR__ . '/../config/lang-manager.php' => config_path('lang-manager.php'),
        ], 'lang-manager-config');

        // Publish the views, enabling users to override and customize them
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/lang-manager'),
        ], 'lang-manager-views');

        // Publish the CSS assets, allowing users to modify the styling
        $this->publishes([
            __DIR__ . '/resources/css/lang-manager.css' => public_path('css/lang-manager.css'),
        ], 'lang-manager-assets');

        // Register Artisan commands if the application is running in the console
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Riadh\LaravelLangManager\Console\Commands\MakeTranslationFile::class,
            ]);
        }

        // Automatically create the `resources/lang` directory if it doesn't exist
        if (!is_dir(resource_path('lang'))) {
            mkdir(resource_path('lang'), 0755, true);
        }

        // Log a message to confirm that the ServiceProvider has been loaded
        Log::info('LangManagerServiceProvider loaded successfully.');
    }
}
