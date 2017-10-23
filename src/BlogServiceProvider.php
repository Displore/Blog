<?php

namespace Displore\Blog;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
        $this->defineAssetsPublishing();

        // Blog::auth(function($request) {
        //     return true;
        // });
    }

    protected function registerRoutes()
    {
        Route::group([
            'prefix' => config('displore.blog.prefix'),
            'namespace' => 'Displore\Blog\Http\Controllers',
            'middleware' => 'web',
            'as' => 'displore.blog::'
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'displore.blog');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'displore.blog');
    }

    protected function defineAssetsPublishing()
    {
        // Public assets
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/displore/blog'),
        ], 'displore.blog.public');

        // Config file
        $this->publishes([
            __DIR__.'/../config/blog.php' => config_path('displore/blog.php'),
        ], 'displore.blog.config');

        // Views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/displore/blog'),
        ]);

        // Translations
        /*
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/displore/blog'),
        ]);
         */
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();       

        $this->app->singleton('Displore\Blog', function ($app) {
            return new Supervisor;
        }); 
    }

    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/blog.php', 'displore.blog'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Displore\Blog'];
    }
}