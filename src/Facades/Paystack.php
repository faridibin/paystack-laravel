<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Paystack Laravel Facade.
 *
 * Provides static access to the Paystack SDK singleton registered in the IoC container.
 * All service method calls are proxied through {@see \Faridibin\Paystack\Paystack}.
 *
 * @method static \Faridibin\Paystack\Services\Commerce\PaymentPages paymentPages()
 * @method static \Faridibin\Paystack\Services\Commerce\Products products()
 *
 * @method static \Faridibin\Paystack\Services\Payments\Transactions\Transactions transactions()
 * @method static \Faridibin\Paystack\Services\Payments\Transactions\Splits splits()
 * @method static \Faridibin\Paystack\Services\Payments\ApplePay applepay()
 * @method static \Faridibin\Paystack\Services\Payments\BulkCharges bulkCharges()
 * @method static \Faridibin\Paystack\Services\Payments\Charge charge()
 * @method static \Faridibin\Paystack\Services\Payments\Customers customers()
 * @method static \Faridibin\Paystack\Services\Payments\DedicatedAccount dedicatedAccount()
 * @method static \Faridibin\Paystack\Services\Payments\Disputes disputes()
 * @method static \Faridibin\Paystack\Services\Payments\PaymentRequests paymentRequests()
 * @method static \Faridibin\Paystack\Services\Payments\Refunds refunds()
 * @method static \Faridibin\Paystack\Services\Payments\Settlements settlements()
 * @method static \Faridibin\Paystack\Services\Payments\Subaccounts subaccounts()
 * @method static \Faridibin\Paystack\Services\Payments\Terminal terminal()
 *
 * @method static \Faridibin\Paystack\Services\Recurring\Plans plans()
 * @method static \Faridibin\Paystack\Services\Recurring\Subscriptions subscriptions()
 *
 * @method static \Faridibin\Paystack\Services\Transfers\Transfers transfers()
 * @method static \Faridibin\Paystack\Services\Transfers\Control control()
 * @method static \Faridibin\Paystack\Services\Transfers\Recipients recipients()
 *
 * @method static \Faridibin\Paystack\Services\Balance balance()
 * @method static \Faridibin\Paystack\Services\DirectDebit directDebit()
 * @method static \Faridibin\Paystack\Services\Integration integration()
 * @method static \Faridibin\Paystack\Services\Miscellaneous miscellaneous()
 * @method static \Faridibin\Paystack\Services\Order order()
 * @method static \Faridibin\Paystack\Services\Storefront storefront()
 * @method static \Faridibin\Paystack\Services\Verification verification()
 * @method static \Faridibin\Paystack\Services\VirtualTerminal virtualTerminal()
 *
 * @method static \Faridibin\Paystack\Health health()
 *
 * @see \Faridibin\Paystack\Paystack
 */
class Paystack extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'paystack';
    }
}
