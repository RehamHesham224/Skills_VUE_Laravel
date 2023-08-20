<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TestResponse::macro('assertResource',function($resource){
            $this->assertJson($resource->response()->getData(true));
        });
    }
}
