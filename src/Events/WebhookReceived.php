<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Faridibin\Paystack\Enums\WebhookEvent;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched immediately when any Paystack webhook request is received and validated.
 *
 * This event fires before any event-specific handling occurs. Use this to log
 * or audit all incoming webhook events.
 */
class WebhookReceived
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new WebhookReceived instance.
     *
     * @param \Faridibin\Paystack\Enums\WebhookEvent|null $event The recognized webhook event type, or null if unrecognized
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public WebhookEvent $event,
        public array $data
    ) {
        //
    }
}
