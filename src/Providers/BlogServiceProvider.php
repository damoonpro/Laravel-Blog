<?php

namespace Damoon\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database' => $this->app->databasePath('/'),
        ]);

        require __DIR__.'/../routes/v1/api.php';
        require __DIR__.'/../routes/v1/User/api.php';
    }
}
