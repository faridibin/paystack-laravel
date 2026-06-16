<?php

use Faridibin\Paystack\Services\Balance;
use Faridibin\Paystack\Services\DirectDebit;
use Faridibin\Paystack\Services\Order;
use Faridibin\Paystack\Services\Storefront;
use Faridibin\Paystack\Services\VirtualTerminal;
use Faridibin\PaystackLaravel\PaystackServices;

it('returns all payment services when no filter is given', function () {
    $services = PaystackServices::payments();

    expect($services)
        ->toHaveKey('transactions')
        ->toHaveKey('customers')
        ->toHaveKey('terminal')
        ->toHaveKey('dedicatedAccount');
});

it('returns only requested payment services', function () {
    $services = PaystackServices::payments(['transactions' => true, 'customers' => false]);

    expect($services)
        ->toHaveKey('transactions')
        ->not->toHaveKey('customers');
});

it('returns all transfer services when no filter is given', function () {
    $services = PaystackServices::transfers();

    expect($services)
        ->toHaveKey('transfers')
        ->toHaveKey('recipients')
        ->toHaveKey('control');
});

it('returns all recurring services when no filter is given', function () {
    $services = PaystackServices::recurring();

    expect($services)->toHaveKey('plans')->toHaveKey('subscriptions');
});

it('returns balance service when enabled', function () {
    $services = PaystackServices::balance();

    expect($services)->toHaveKey('balance');
    expect($services['balance'][0])->toBe(Balance::class);
});

it('returns empty array when balance is disabled', function () {
    expect(PaystackServices::balance(false))->toBeEmpty();
});

it('returns virtual terminal service when enabled', function () {
    $services = PaystackServices::virtualTerminal();

    expect($services)->toHaveKey('virtualTerminal');
    expect($services['virtualTerminal'][0])->toBe(VirtualTerminal::class);
});

it('returns direct debit service when enabled', function () {
    $services = PaystackServices::directDebit();

    expect($services)->toHaveKey('directDebit');
    expect($services['directDebit'][0])->toBe(DirectDebit::class);
});

it('returns storefront service when enabled', function () {
    $services = PaystackServices::storefront();

    expect($services)->toHaveKey('storefront');
    expect($services['storefront'][0])->toBe(Storefront::class);
});

it('returns order service when enabled', function () {
    $services = PaystackServices::order();

    expect($services)->toHaveKey('order');
    expect($services['order'][0])->toBe(Order::class);
});

it('getEnabledServices merges all configured services into a flat map', function () {
    $services = PaystackServices::getEnabledServices();

    expect($services)
        ->toBeArray()
        ->toHaveKey('transactions')
        ->toHaveKey('customers')
        ->toHaveKey('transfers')
        ->toHaveKey('plans')
        ->toHaveKey('balance')
        ->toHaveKey('dedicatedAccount');
});
