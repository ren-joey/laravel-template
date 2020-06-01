<?php

namespace App\Providers;

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
        // $this->app->bind(\App\PaymentInterface::class, function () {
        //     return new \App\PaypalPayment();
        //     // return new \App\Payment();
        // });

        $this->app->bind('App\PaymentInterface', function () {
            // return new \App\PaymentInterface($app->make('PaypalPayment'));
            return new \App\PaypalPayment();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
