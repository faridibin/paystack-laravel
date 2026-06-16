<?php

use Faridibin\Paystack\Enums\WebhookEvent;

it('webhook event enum has all expected cases', function () {
    $events = WebhookEvent::values();

    expect($events)
        ->toContain('charge.success')
        ->toContain('transfer.success')
        ->toContain('subscription.create')
        ->toContain('refund.processed')
        ->toContain('dedicatedaccount.assign.success');
});

it('webhook event enum provides descriptions', function () {
    expect(WebhookEvent::CHARGE_SUCCESS->description())->toBeString()->not->toBeEmpty();
});
