<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when Paystack fires a `transfer.reversed` webhook event.
 *
 * Listen to this event to handle a transfer has been reversed.
 * The `$data` property contains the raw payload from Paystack.
 *
 * @see https://paystack.com/docs/payments/webhooks/
 */
class TransferReversedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new TransferReversedEvent instance.
     *
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public array $data
    ) {
        //
    }
}
