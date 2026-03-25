<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (class_exists('Maatwebsite\\Excel\\ExcelServiceProvider')) {
            $this->app->register('Maatwebsite\\Excel\\ExcelServiceProvider');
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Excel', 'Maatwebsite\\Excel\\Facades\\Excel');
        }
    }
}
