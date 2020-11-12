<?php

namespace hanbz\PassportClient;

use Illuminate\Support\ServiceProvider;
use hanbz\PassportClient\Contracts\Factory;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new SocialiteManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }

    /**
     * Determine if the provider is deferred.
     *
     * @return bool
     */
    public function isDeferred()
    {
        return true;
    }
}
