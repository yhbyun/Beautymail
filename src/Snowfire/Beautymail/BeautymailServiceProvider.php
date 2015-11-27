<?php

namespace Snowfire\Beautymail;

use Illuminate\Support\ServiceProvider;

class BeautymailServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/settings.php' => config_path('beautymail.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../../../public' => public_path('vendor/beautymail'),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../../views', 'beautymail');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'Snowfire\Beautymail\Beautymail',
            function ($app) {
                return new \Snowfire\Beautymail\Beautymail(config('beautymail.view'));
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Snowfire\Beautymail\Beautymail'];
    }
}
