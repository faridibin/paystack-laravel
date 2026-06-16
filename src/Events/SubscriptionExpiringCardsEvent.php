<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when Paystack fires a `subscription.expiring_cards` webhook event.
 *
 * Listen to this event to handle subscriptions with expiring cards have been identified.
 * The `$data` property contains the raw payload from Paystack.
 *
 * @see https://paystack.com/docs/payments/webhooks/
 */
class SubscriptionExpiringCardsEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new SubscriptionExpiringCardsEvent instance.
     *
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public array $data
    ) {
        //
    }
}
