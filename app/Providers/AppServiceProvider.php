<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\PaymentInterface;
use App\PaypalPayment;
use App\TestClass;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        PaymentInterface::class => PaypalPayment::class,
        'bindTestClass' => TestClass::class,
    ];

    public $singletons = [
        // PaymentInterface::class => PaypalPayment::class
        'singletonTestClass' => TestClass::class
    ];

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

        // $this->app->bind('App\PaymentInterface', function () {
        //     // return new \App\PaymentInterface($app->make('PaypalPayment'));
        //     return new \App\PaypalPayment();
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(PaymentInterface $paypal)
    {
        // echo $paypal->pay();
    }
}
