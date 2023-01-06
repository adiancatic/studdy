<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive("ob", function () {
            return "<?php ob_start(); ?>";
        });

        Blade::directive("endob", function ($variable) {
            return "<?php $$variable = ob_get_clean(); ?>";
        });
    }
}
