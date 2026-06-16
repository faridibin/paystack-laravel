<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when Paystack fires a `dedicatedaccount.assign.failed` webhook event.
 *
 * Listen to this event to handle a dedicated virtual account could not be created and assigned.
 * The `$data` property contains the raw payload from Paystack.
 *
 * @see https://paystack.com/docs/payments/webhooks/
 */
class DedicatedaccountAssignFailedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new DedicatedaccountAssignFailedEvent instance.
     *
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public array $data
    ) {
        //
    }
}
