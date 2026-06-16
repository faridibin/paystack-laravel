<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when Paystack fires a `charge.dispute.remind` webhook event.
 *
 * Listen to this event to handle a logged dispute has not been resolved and requires attention.
 * The `$data` property contains the raw payload from Paystack.
 *
 * @see https://paystack.com/docs/payments/webhooks/
 */
class ChargeDisputeRemindEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new ChargeDisputeRemindEvent instance.
     *
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public array $data
    ) {
        //
    }
}
