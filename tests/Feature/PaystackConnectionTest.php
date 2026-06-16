<?php

use Faridibin\Paystack\Services\Payments\Customers;
use Faridibin\Paystack\Services\Payments\Transactions\Transactions;
use Faridibin\Paystack\Services\Recurring\Plans;
use Faridibin\Paystack\Services\Transfers\Transfers;
use Faridibin\PaystackLaravel\Facades\Paystack;

it('resolves the transactions service via facade', function () {
    expect(Paystack::transactions())->toBeInstanceOf(Transactions::class);
});

it('resolves the customers service via facade', function () {
    expect(Paystack::customers())->toBeInstanceOf(Customers::class);
});

it('resolves the transfers service via facade', function () {
    expect(Paystack::transfers())->toBeInstanceOf(Transfers::class);
});

it('resolves the plans service via facade', function () {
    expect(Paystack::plans())->toBeInstanceOf(Plans::class);
});
