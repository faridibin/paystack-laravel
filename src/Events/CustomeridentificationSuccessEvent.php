<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when Paystack fires a `customeridentification.success` webhook event.
 *
 * Listen to this event to handle a customer identity validation was successful.
 * The `$data` property contains the raw payload from Paystack.
 *
 * @see https://paystack.com/docs/payments/webhooks/
 */
class CustomeridentificationSuccessEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new CustomeridentificationSuccessEvent instance.
     *
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public array $data
    ) {
        //
    }
}
