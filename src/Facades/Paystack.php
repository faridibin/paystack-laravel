<?php

namespace Faridibin\PaystackLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Faridibin\Paystack\Services\Commerce\PaymentPages paymentPages()
 * @method static \Faridibin\Paystack\Services\Commerce\Products products()
 *
 * @method static \Faridibin\Paystack\Services\Payments\Transactions\Transactions transactions()
 * @method static \Faridibin\Paystack\Services\Payments\Transactions\Splits splits()
 * @method static \Faridibin\Paystack\Services\Payments\ApplePay applepay()
 * @method static \Faridibin\Paystack\Services\Payments\BulkCharges bulkCharges()
 * @method static \Faridibin\Paystack\Services\Payments\Charge charge()
 * @method static \Faridibin\Paystack\Services\Payments\Customers customers()
 * @method static \Faridibin\Paystack\Services\Payments\Disputes disputes()
 * @method static \Faridibin\Paystack\Services\Payments\PaymentRequests paymentRequests()
 * @method static \Faridibin\Paystack\Services\Payments\Refunds refunds()
 * @method static \Faridibin\Paystack\Services\Payments\Settlements settlements()
 * @method static \Faridibin\Paystack\Services\Payments\SubAccounts subAccounts()
 * @method static \Faridibin\Paystack\Services\Payments\Terminal terminal()
 *
 * @method static \Faridibin\Paystack\Services\Recurring\Plans plans()
 * @method static \Faridibin\Paystack\Services\Recurring\Subscriptions subscriptions()
 *
 * @method static \Faridibin\Paystack\Services\Transfers\Transfers transfers()
 * @method static \Faridibin\Paystack\Services\Transfers\Control controls()
 * @method static \Faridibin\Paystack\Services\Transfers\Recipients recipients()
 *
 * @method static \Faridibin\Paystack\Services\Integration integration()
 * @method static \Faridibin\Paystack\Services\Verification verification()
 * @method static \Faridibin\Paystack\Services\Miscellaneous miscellaneous()
 *
 * @method static \Faridibin\Paystack\Health health()
 *
 * @see \Faridibin\Paystack\Paystack
 */
class Paystack extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'paystack';
    }
}
