<?php

namespace Tests;

use Faridibin\PaystackLaravel\PaystackServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [PaystackServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Paystack' => \Faridibin\PaystackLaravel\Facades\Paystack::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('paystack.secret_key', 'sk_test_abc123');
    }
}
