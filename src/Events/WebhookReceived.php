<?php

namespace Faridibin\PaystackLaravel\Events;

use Faridibin\Paystack\Enums\WebhookEvent;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebhookReceived
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new WebhookReceived event instance.
     * 
     * @param \Faridibin\Paystack\Enums\WebhookEvent $event
     * @param array $data
     */
    public function __construct(
        public WebhookEvent $event,
        public array $data
    ) {
        //
    }
}
