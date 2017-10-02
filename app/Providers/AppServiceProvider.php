<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\Contracts\RecipeServiceContract', 'App\Services\RecipeService'
        );
        $this->app->bind(
            'App\Services\Contracts\IngredientServiceContract', 'App\Services\IngredientService'
        );
    }
}
