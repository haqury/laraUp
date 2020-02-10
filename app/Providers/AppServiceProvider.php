<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('isRole', function ($string) {
            $string = !is_array($string) ? $string : implode(',', $string);
            return '<?php if(!empty(auth()->user()) && auth()->user()->hasRole("' . $string . '")) { ?>';
        });

        Blade::directive('endIsRole', function () {
            return '<?php } ?>';
        });


        Blade::directive('controller', function ($controllerName) {
            $controllerAction = explode('@', $controllerName);
            $controllerName = '\App\Http\Controllers\\' . $controllerAction[0];
            $action = $controllerAction[1];
            $controller = new $controllerName;
            return $controller->$action();
        });
    }
}
