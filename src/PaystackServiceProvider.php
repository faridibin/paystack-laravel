<?php

namespace Faridibin\PaystackLaravel;

use Faridibin\Paystack\Paystack as PaystackSDK;
use Illuminate\Support\ServiceProvider;

class PaystackServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/paystack.php',
            'paystack'
        );

        $this->app->singleton('paystack', function ($app) {
            $sdk = new PaystackSDK(config('paystack.secret_key'));

            $sdk->registerServices(PaystackServices::getEnabledServices());

            return $sdk;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/paystack.php' => config_path('paystack.php'),
        ], 'paystack-config');

        // $this->publishes([
        //     __DIR__ . '/../database/migrations' => database_path('migrations'),
        // ], 'paystack-migrations');
    }
}
