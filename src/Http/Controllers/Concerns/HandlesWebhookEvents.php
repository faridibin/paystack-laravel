<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Http\Controllers\Concerns;

use Faridibin\PaystackLaravel\Events\{
    ChargeDisputeCreatedEvent,
    ChargeDisputeRemindEvent,
    ChargeDisputeResolvedEvent,
    ChargeSuccessEvent,
    CustomeridentificationFailedEvent,
    CustomeridentificationSuccessEvent,
    DedicatedaccountAssignFailedEvent,
    DedicatedaccountAssignSuccessEvent,
    InvoiceCreatedEvent,
    InvoicePaymentFailedEvent,
    InvoiceUpdateEvent,
    PaymentrequestPendingEvent,
    PaymentrequestSucceededEvent,
    RefundFailedEvent,
    RefundPendingEvent,
    RefundProcessedEvent,
    RefundProcessingEvent,
    SubscriptionCreatedEvent,
    SubscriptionDisabledEvent,
    SubscriptionExpiringCardsEvent,
    SubscriptionNotRenewedEvent,
    TransferFailedEvent,
    TransferReversedEvent,
    TransferSucceededEvent,
};
use Symfony\Component\HttpFoundation\Response;

/**
 * Provides handler methods for all supported Paystack webhook events.
 *
 * Each method dispatches the corresponding Laravel event class and returns
 * a success response. Add this trait to your webhook controller.
 *
 * @see \Faridibin\PaystackLaravel\Http\Controllers\WebhookController
 */
trait HandlesWebhookEvents
{
    /**
     * Handle charge successful event.
     * 
     * @param array $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onChargeSuccess(array $payload): Response
    {
        ChargeSuccessEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle charge dispute create event.
     * 
     * @param array $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onChargeDisputeCreate(array $payload): Response
    {
        ChargeDisputeCreatedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle charge dispute remind event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onChargeDisputeRemind(array $payload): Response
    {
        ChargeDisputeRemindEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle charge dispute resolve event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onChargeDisputeResolve(array $payload): Response
    {
        ChargeDisputeResolvedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle customer identification failed event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onCustomeridentificationFailed(array $payload): Response
    {
        CustomeridentificationFailedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle customer identification success event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onCustomeridentificationSuccess(array $payload): Response
    {
        CustomeridentificationSuccessEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle dedicated account assign failed event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onDedicatedaccountAssignFailed(array $payload): Response
    {
        DedicatedaccountAssignFailedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle dedicated account assign success event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onDedicatedaccountAssignSuccess(array $payload): Response
    {
        DedicatedaccountAssignSuccessEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle invoice create event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onInvoiceCreate(array $payload): Response
    {
        InvoiceCreatedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle invoice payment failed event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onInvoicePaymentFailed(array $payload): Response
    {
        InvoicePaymentFailedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle invoice update event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onInvoiceUpdate(array $payload): Response
    {
        InvoiceUpdateEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle payment request pending event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onPaymentrequestPending(array $payload): Response
    {
        PaymentrequestPendingEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle payment request success event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onPaymentrequestSuccess(array $payload): Response
    {
        PaymentrequestSucceededEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle refund failed event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onRefundFailed(array $payload): Response
    {
        RefundFailedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle refund pending event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onRefundPending(array $payload): Response
    {
        RefundPendingEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle refund processed event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onRefundProcessed(array $payload): Response
    {
        RefundProcessedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle refund processing event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onRefundProcessing(array $payload): Response
    {
        RefundProcessingEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle subscription create event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onSubscriptionCreate(array $payload): Response
    {
        SubscriptionCreatedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle subscription disable event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onSubscriptionDisable(array $payload): Response
    {
        SubscriptionDisabledEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle subscription expiring cards event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onSubscriptionExpiringCards(array $payload): Response
    {
        SubscriptionExpiringCardsEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle subscription not renew event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onSubscriptionNotRenew(array $payload): Response
    {
        SubscriptionNotRenewedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle transfer failed event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onTransferFailed(array $payload): Response
    {
        TransferFailedEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle transfer success event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onTransferSuccess(array $payload): Response
    {
        TransferSucceededEvent::dispatch($payload);

        return $this->successMethod();
    }

    /**
     * Handle transfer reversed event.
     *
     * @param array $payload The webhook event data from Paystack
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onTransferReversed(array $payload): Response
    {
        TransferReversedEvent::dispatch($payload);

        return $this->successMethod();
    }
}
