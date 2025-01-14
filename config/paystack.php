<?php

use Faridibin\Paystack\Enums\Currency;
use Faridibin\PaystackLaravel\Http\Middleware\ValidateWebhookSignature;
use Faridibin\PaystackLaravel\PaystackServices;

return  [

    /*
    |--------------------------------------------------------------------------
    | Paystack Secret Key
    |--------------------------------------------------------------------------
    |
    | This value is the secret key of your Paystack account. It is required
    | to authenticate requests to the Paystack API. You can get your secret
    | key from your Paystack dashboard.
    |
    */

    'secret_key' => env('PAYSTACK_SECRET_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Paystack Default Currency
    |--------------------------------------------------------------------------
    |
    | This value is the default currency that will be used for transactions
    | on your Paystack account. It is used when creating/performing actions that
    | do not have a specified currency.
    |
    */

    'currency' => env('PAYSTACK_CURRENCY', Currency::NGN),

    /*
    |--------------------------------------------------------------------------
    | Enabled Services
    |--------------------------------------------------------------------------
    |
    | This value is an array of services that you want to enable in the Paystack
    | SDK. Each service has a corresponding class that implements the service
    | interface.
    |
    */

    'services' => [
        PaystackServices::commerce([
            'products' => true,
            'paymentPages' => true,
        ]),
        PaystackServices::payments([
            'transactions' => true,
            'splits' => true,
            'applepay' => true,
            'bulkCharges' => true,
            'charge' => true,
            'customers' => true,
            'disputes' => true,
            'paymentRequests' => true,
            'refunds' => true,
            'settlements' => true,
            'subaccounts' => true,
            'terminal' => true,
        ]),
        PaystackServices::recurring([
            'plans' => true,
            'subscriptions' => true,
        ]),
        PaystackServices::transfers([
            'transfers' => true,
            'recipients' => true,
            'control' => true,
        ]),
        PaystackServices::integration(),
        PaystackServices::verification(),
        PaystackServices::miscellaneous(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Paystack Routes
    |--------------------------------------------------------------------------
    |
    | This value is an array of configurations for the Paystack routes. You can
    | enable or disable the routes and also add middleware to the routes.
    |
    */

    'routes' => [

        'enabled' => true,

        /*
        |--------------------------------------------------------------------------
        | Route Middleware
        |--------------------------------------------------------------------------
        |
        | This value is an array of middleware that will be applied to the Paystack
        | routes. You can add your own middleware to this array if you want to
        | apply them to the Paystack routes.
        |
        */

        'middleware' => [

            'transaction.fetch' => [
                'web'
            ],

            'webhook.handle' => [
                ValidateWebhookSignature::class
            ]
        ]
    ],


];
