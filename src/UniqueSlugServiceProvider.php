<?php

namespace Akash\LaravelUniqueSlug;

use Illuminate\Support\ServiceProvider;

class UniqueSlugServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-unique-slug', function($app) {
            return new \Akash\LaravelUniqueSlug\UniqueSlug();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-unique-slug.php', 'laravel-unique-slug'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-unique-slug.php' => config_path('laravel-unique-slug.php'),
        ]);
    }
}
