<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Support\ServiceProvider;

class InstagramProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/instagram.php', 'instagram'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../migrations' => database_path('migrations')
        ], 'instagram-migrations');

        $this->publishes([
            __DIR__ . '/../config/instagram.php' => config_path('instagram.php')
        ], 'instagram-config');
    }
}
