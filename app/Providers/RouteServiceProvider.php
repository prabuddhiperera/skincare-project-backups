<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    
   
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public const HOME = '/welcome';
    
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

    }
}