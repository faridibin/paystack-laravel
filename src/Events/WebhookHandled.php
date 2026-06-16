<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Faridibin\Paystack\Enums\WebhookEvent;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched after a Paystack webhook event has been successfully handled.
 *
 * This event fires after the specific event handler method has been called.
 * The `$event` will be null if the event type was not recognized.
 */
class WebhookHandled
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new WebhookHandled instance.
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
