<?php

namespace Edalzell\StatamicSettings;

use Illuminate\Support\ServiceProvider;
use Edalzell\StatamicSettings\Commands\StatamicSettingsCommand;

class StatamicSettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/statamic-settings.php' => config_path('statamic-settings.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/statamic-settings'),
            ], 'views');

            $migrationFileName = 'create_statamic_settings_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                StatamicSettingsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'statamic-settings');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/statamic-settings.php', 'statamic-settings');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
