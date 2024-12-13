<?php

namespace Faridibin\PaystackLaravel;

use Faridibin\Paystack\{Contracts, Services};

class PaystackServices
{
    /**
     * Available commerce services.
     */
    protected static array $commerceServices = [
        'products' => [Services\Commerce\Products::class, Contracts\Services\Commerce\ProductsInterface::class],
        'paymentPages' => [Services\Commerce\PaymentPages::class, Contracts\Services\Commerce\PaymentPagesInterface::class],
    ];

    /**
     * Available payments services.
     */
    protected static array $paymentServices = [
        'transactions' => [Services\Payments\Transactions\Transactions::class, Contracts\Services\Payments\Transactions\TransactionsInterface::class],
        'splits' => [Services\Payments\Transactions\Splits::class, Contracts\Services\Payments\Transactions\SplitsInterface::class],
        'customers' => [Services\Payments\Customers::class, Contracts\Services\Payments\CustomersInterface::class],
        'terminal' => [Services\Payments\Terminal::class, Contracts\Services\Payments\TerminalInterface::class],
        'applepay' => [Services\Payments\ApplePay::class, Contracts\Services\Payments\ApplePayInterface::class],
        'subaccounts' => [Services\Payments\Subaccounts::class, Contracts\Services\Payments\SubaccountsInterface::class],
        'settlements' => [Services\Payments\Settlements::class, Contracts\Services\Payments\SettlementsInterface::class],
        'bulkCharges' => [Services\Payments\BulkCharges::class, Contracts\Services\Payments\BulkChargesInterface::class],
        'charge' => [Services\Payments\Charge::class, Contracts\Services\Payments\ChargeInterface::class],
        'disputes' => [Services\Payments\Disputes::class, Contracts\Services\Payments\DisputesInterface::class],
        'paymentRequests' => [Services\Payments\PaymentRequests::class, Contracts\Services\Payments\PaymentRequestsInterface::class],
        'refunds' => [Services\Payments\Refunds::class, Contracts\Services\Payments\RefundsInterface::class],
    ];

    /**
     * Available recurring services.
     */
    protected static array $recurringServices = [
        'plans' => [Services\Recurring\Plans::class, Contracts\Services\Recurring\PlansInterface::class],
        'subscriptions' => [Services\Recurring\Subscriptions::class, Contracts\Services\Recurring\SubscriptionsInterface::class],
    ];

    /**
     * Available transfers services.
     */
    protected static array $transferServices = [
        'transfers' => [Services\Transfers\Transfers::class, Contracts\Services\Transfers\TransfersInterface::class],
        'recipients' => [Services\Transfers\Recipients::class, Contracts\Services\Transfers\RecipientsInterface::class],
        'control' => [Services\Transfers\Control::class, Contracts\Services\Transfers\ControlInterface::class],
    ];

    /**
     * Determine if the given service is enabled.
     *
     * @param  string  $service
     * @return bool
     */
    public static function enabled(string $service): bool
    {
        $enabledServices = static::getEnabledServices();

        return isset($enabledServices[$service]);
    }

    public static function serviceEnabled(string $service): bool
    {
        // TODO: Implement serviceEnabled() method.
        return true;
    }

    /**
     * Get all enabled services.
     *
     * @return array<string, array>
     */
    public static function getEnabledServices(): array
    {
        $config = config('paystack.services', []);

        if (empty($config)) {
            return [];
        }

        return array_merge([], ...array_values($config));
    }

    /**
     * Enable specific commerce services.
     * If no services are provided, all commerce services will be enabled.
     *
     * @param array<string, bool> $services
     */
    public static function commerce(array $services = []): array
    {
        return static::enableService(static::$commerceServices, $services);
    }

    /**
     * Enable specific payments services.
     * If no services are provided, all payments services will be enabled.
     *
     * @param array<string, bool> $services
     */
    public static function payments(array $services = []): array
    {
        return static::enableService(static::$paymentServices, $services);
    }

    /**
     * Enable specific recurring services.
     * If no services are provided, all recurring services will be enabled.
     *
     * @param array<string, bool> $services
     */
    public static function recurring(array $services = []): array
    {
        return static::enableService(static::$recurringServices, $services);
    }

    /**
     * Enable specific transfers services.
     * If no services are provided, all transfers services will be enabled.
     *
     * @param array<string, bool> $services
     */
    public static function transfers(array $services = []): array
    {
        return static::enableService(static::$transferServices, $services);
    }

    /**
     * Enable the integration service.
     */
    public static function integration(bool $enable = true): array
    {
        if (!$enable) {
            return [];
        }

        return [
            'integration' => [Services\Integration::class, Contracts\Services\IntegrationInterface::class]
        ];
    }

    /**
     * Enable the verification service.
     */
    public static function verification(bool $enable = true): array
    {
        if (!$enable) {
            return [];
        }

        return [
            'verification' => [Services\Verification::class, Contracts\Services\VerificationInterface::class]
        ];
    }

    /**
     * Enable the miscellaneous service.
     */
    public static function miscellaneous(bool $enable = true): array
    {
        if (!$enable) {
            return [];
        }

        return [
            'miscellaneous' => [Services\Miscellaneous::class, Contracts\Services\MiscellaneousInterface::class]
        ];
    }

    /**
     * Enable the given services.
     *
     * @param array<string, array> $available
     * @param array<string, bool> $requested
     * @return array<string, array>
     */
    protected static function enableService(array $available, array $requested = []): array
    {
        if (empty($requested)) {
            return $available;
        }

        $enabledServices = [];

        foreach ($requested as $service => $enabled) {
            if ($enabled && isset($available[$service])) {
                $enabledServices[$service] = $available[$service];
            }
        }

        return $enabledServices;
    }
}
