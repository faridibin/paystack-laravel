<?php

use Faridibin\Paystack\Enums\WebhookEvent;
use Faridibin\PaystackLaravel\Events\ChargeSuccessEvent;
use Faridibin\PaystackLaravel\Events\TransferSucceededEvent;
use Faridibin\PaystackLaravel\Events\WebhookHandled;
use Faridibin\PaystackLaravel\Events\WebhookReceived;
use Illuminate\Support\Facades\Event;

function webhookPayload(string $event, array $data = []): string
{
    return json_encode(['event' => $event, 'data' => $data]);
}

function webhookSignature(string $payload): string
{
    return hash_hmac('sha512', $payload, 'sk_test_abc123');
}

function sendWebhook($test, string $event, array $data = [])
{
    $payload = webhookPayload($event, $data);

    return $test->call(
        'POST',
        route('paystack.webhook.handle'),
        [],
        [],
        [],
        [
            'REMOTE_ADDR' => '52.31.139.75',
            'HTTP_X_PAYSTACK_SIGNATURE' => webhookSignature($payload),
            'CONTENT_TYPE' => 'application/json',
        ],
        $payload
    );
}

it('rejects a request with no signature header', function () {
    $this->postJson(route('paystack.webhook.handle'), ['event' => 'charge.success', 'data' => []])
        ->assertStatus(403);
});

it('rejects a request with an invalid signature', function () {
    $this->call(
        'POST',
        route('paystack.webhook.handle'),
        [],
        [],
        [],
        ['REMOTE_ADDR' => '52.31.139.75', 'HTTP_X_PAYSTACK_SIGNATURE' => 'bad-sig', 'CONTENT_TYPE' => 'application/json'],
        webhookPayload('charge.success')
    )->assertStatus(403);
});

it('dispatches WebhookReceived for any valid webhook', function () {
    Event::fake();

    sendWebhook($this, 'charge.success', ['id' => 1]);

    Event::assertDispatched(WebhookReceived::class, fn($e) => $e->event === WebhookEvent::CHARGE_SUCCESS);
});

it('dispatches ChargeSuccessEvent for charge.success', function () {
    Event::fake();

    sendWebhook($this, 'charge.success', ['id' => 1, 'reference' => 'ref_xxx']);

    Event::assertDispatched(ChargeSuccessEvent::class, fn($e) => $e->data['reference'] === 'ref_xxx');
    Event::assertDispatched(WebhookHandled::class);
});

it('dispatches TransferSucceededEvent for transfer.success', function () {
    Event::fake();

    sendWebhook($this, 'transfer.success', ['transfer_code' => 'TRF_xxx']);

    Event::assertDispatched(TransferSucceededEvent::class, fn($e) => $e->data['transfer_code'] === 'TRF_xxx');
});

it('returns 200 for a known event', function () {
    Event::fake();

    $response = sendWebhook($this, 'charge.success');

    expect($response->getStatusCode())->toBe(200);
});
