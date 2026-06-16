<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when Paystack fires a `invoice.payment_failed` webhook event.
 *
 * Listen to this event to handle a payment attempt for an invoice has failed.
 * The `$data` property contains the raw payload from Paystack.
 *
 * @see https://paystack.com/docs/payments/webhooks/
 */
class InvoicePaymentFailedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new InvoicePaymentFailedEvent instance.
     *
     * @param array $data The raw webhook payload data from Paystack
     */
    public function __construct(
        public array $data
    ) {
        //
    }
}
