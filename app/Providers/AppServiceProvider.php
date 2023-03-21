<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LdapRecord\Laravel\Middleware\WindowsAuthenticate;

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
        WindowsAuthenticate::guards(['api']);
    }
}
