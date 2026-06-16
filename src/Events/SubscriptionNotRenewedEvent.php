<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when Paystack fires a `subscription.not_renew` webhook event.
 *
 * Listen to this event to handle a subscription has been set to non-renewing status.
 * The `$data` property contains the raw payload from Paystack.
 *
 * @see https://paystack.com/docs/payments/webhooks/
 */
class SubscriptionNotRenewedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new SubscriptionNotRenewedEvent instance.
     *
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public array $data
    ) {
        //
    }
}
