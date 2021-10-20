<?php

namespace DcodeGroup\InstagramFeed;

use Illuminate\Support\ServiceProvider;
use League\OAuth2\Client\Provider\Instagram;

class InstagramProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'instagram');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/instagram.php', 'instagram'
        );

        $this->app->bind(Instagram::class, function ($app) {
            return new Instagram([
                'clientId'          => $app['config']->get('instagram.oauth.client_id'),
                'clientSecret'      => $app['config']->get('instagram.oauth.client_secret'),
                'redirectUri'       => route($app['config']->get('instagram.redirect_route')),
                'host'              => 'https://api.instagram.com',
                'graphHost'         => 'https://graph.instagram.com',
            ]);
        });
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
