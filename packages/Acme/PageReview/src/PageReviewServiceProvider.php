<?php
namespace Acme\PageReview;
use Illuminate\Support\ServiceProvider;
class PageReviewServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Load the migration files.
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // Load the view files.
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pagereview');
        // Set a group namespace for the routes defined, then load the route file.
        $this->app['router']->namespace('Acme\\PageReview\\Controllers')
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pagereview.php', 'pagereview');
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pagereview'];
    }
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/pagereview.php' => config_path('pagereview.php'),
        ], 'pagereview.config');
        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/creativ          itykills'),
        ], 'pagereview.views');
        // Publishing database migration.
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }
}
