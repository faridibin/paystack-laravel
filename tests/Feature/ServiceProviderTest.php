<?php

use Faridibin\Paystack\Paystack;
use Faridibin\PaystackLaravel\Facades\Paystack as PaystackFacade;

it('registers the paystack singleton in the container', function () {
    $paystack = app('paystack');

    expect($paystack)->toBeInstanceOf(Paystack::class);
});

it('resolves the same instance each time', function () {
    $first = app('paystack');
    $second = app('paystack');

    expect($first)->toBe($second);
});

it('resolves via the facade', function () {
    expect(PaystackFacade::getFacadeRoot())->toBeInstanceOf(Paystack::class);
});

it('publishes the config file', function () {
    $this->artisan('vendor:publish', ['--tag' => 'paystack-config'])->assertExitCode(0);

    expect(config('paystack'))->toBeArray()
        ->toHaveKey('secret_key')
        ->toHaveKey('services')
        ->toHaveKey('routes');
});

it('has the secret key from environment', function () {
    expect(config('paystack.secret_key'))->toBe('sk_test_abc123');
});

it('loads webhook and transaction routes', function () {
    $routes = collect(app('router')->getRoutes()->getRoutes());

    $webhookRoute = $routes->first(fn($r) => $r->getName() === 'paystack.webhook.handle');
    $transactionRoute = $routes->first(fn($r) => $r->getName() === 'paystack.transaction.fetch');

    expect($webhookRoute)->not->toBeNull()
        ->and($transactionRoute)->not->toBeNull();
});
