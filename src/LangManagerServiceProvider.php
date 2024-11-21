<?php

namespace Riadh\LaravelLangManager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

/**
 * @Title Service provider for the Laravel Lang Manager package.
 * @Desciption Handles registration and bootstrapping of services and resources.
 */
class LangManagerServiceProvider extends ServiceProvider
{
    /**
     * @Title : Register any application services.
     *
     * @Desciption : This method is used to merge the package's configuration file
     * into the application's existing configuration.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lang-manager.php', 'lang-manager');
    }

    /**
     *
     * @Title : Boot any application services.
     * @Desciption : This method loads views, publishes configuration files, and performs
     * any other setup required when the package is booted.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load the views provided by the package
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lang-manager');

        // Publish the package's configuration file to the application's config path
        $this->publishes([
            __DIR__ . '/../config/lang-manager.php' => config_path('lang-manager.php'),
        ], 'config');

        // Log a message indicating the service provider has been loaded
        Log::info('LangManagerServiceProvider loaded successfully.');
    }
}
