# Paystack Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/faridibin/paystack-laravel.svg?style=flat-square)](https://packagist.org/packages/faridibin/paystack-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/faridibin/paystack-laravel.svg?style=flat-square)](https://packagist.org/packages/faridibin/paystack-laravel)
[![License](https://img.shields.io/packagist/l/faridibin/paystack-laravel.svg?style=flat-square)](https://packagist.org/packages/faridibin/paystack-laravel)

A Laravel wrapper for [faridibin/paystack-php](https://github.com/faridibin/paystack-php) with service provider, facade, webhook handling, and event dispatching.

## Requirements

- PHP 8.2+
- Laravel 11+

## Installation

```bash
composer require faridibin/paystack-laravel
```

The service provider is auto-discovered — no manual registration needed.

### Publish Configuration

```bash
php artisan vendor:publish --tag=paystack-config
```

This creates `config/paystack.php` in your application.

### Environment Variables

Add your Paystack secret key to `.env`:

```env
PAYSTACK_SECRET_KEY=sk_test_your_secret_key_here
PAYSTACK_CURRENCY=NGN
```

## Usage

### Facade

```php
use Faridibin\PaystackLaravel\Facades\Paystack;

// Initialize a transaction
$response = Paystack::transactions()->initialize(amount: 50000, email: 'customer@example.com');
$authUrl  = $response->getData()->authorization_url;

// Verify a transaction
Paystack::transactions()->verify('ref_abc123');

// Create a customer
Paystack::customers()->create([
    'email'      => 'john@example.com',
    'first_name' => 'John',
    'last_name'  => 'Doe',
]);

// Create a plan
Paystack::plans()->create('Monthly', amount: 10000, interval: 'monthly');

// Initiate a transfer (reference must be unique per request — required for idempotency)
Paystack::transfers()->initiateTransfer(
    amount:    5000,
    recipient: 'RCP_xxx',
    reference: 'salary_2026_04_15',
    optional:  ['reason' => 'Salary'],
);
```

### Available Services

#### Commerce

| Facade call                | Service       |
| -------------------------- | ------------- |
| `Paystack::products()`     | Products      |
| `Paystack::paymentPages()` | Payment Pages |

#### Payments

| Facade call                    | Service            |
| ------------------------------ | ------------------ |
| `Paystack::transactions()`     | Transactions       |
| `Paystack::splits()`           | Transaction Splits |
| `Paystack::customers()`        | Customers          |
| `Paystack::charge()`           | Charge             |
| `Paystack::bulkCharges()`      | Bulk Charges       |
| `Paystack::refunds()`          | Refunds            |
| `Paystack::subaccounts()`      | Subaccounts        |
| `Paystack::disputes()`         | Disputes           |
| `Paystack::settlements()`      | Settlements        |
| `Paystack::paymentRequests()`  | Payment Requests   |
| `Paystack::dedicatedAccount()` | Dedicated Accounts |
| `Paystack::terminal()`         | Terminal           |
| `Paystack::applepay()`         | Apple Pay          |

#### Recurring

| Facade call                 | Service       |
| --------------------------- | ------------- |
| `Paystack::plans()`         | Plans         |
| `Paystack::subscriptions()` | Subscriptions |

#### Transfers

| Facade call              | Service             |
| ------------------------ | ------------------- |
| `Paystack::transfers()`  | Transfers           |
| `Paystack::recipients()` | Transfer Recipients |
| `Paystack::control()`    | Transfer Control    |

#### Other

| Facade call                   | Service          |
| ----------------------------- | ---------------- |
| `Paystack::integration()`     | Integration      |
| `Paystack::verification()`    | Verification     |
| `Paystack::miscellaneous()`   | Miscellaneous    |
| `Paystack::balance()`         | Balance          |
| `Paystack::directDebit()`     | Direct Debit     |
| `Paystack::virtualTerminal()` | Virtual Terminal |
| `Paystack::storefront()`      | Storefront       |
| `Paystack::order()`           | Order            |

## Service Configuration

Enable only the services you need in `config/paystack.php`:

```php
use Faridibin\PaystackLaravel\PaystackServices;

'services' => [
    PaystackServices::payments([
        'transactions' => true,
        'customers'    => true,
        'refunds'      => true,
    ]),
    PaystackServices::recurring([
        'plans'         => true,
        'subscriptions' => true,
    ]),
    PaystackServices::transfers([
        'transfers'  => true,
        'recipients' => true,
    ]),
    PaystackServices::miscellaneous(),
],
```

Calling a group method with no arguments enables all services in that group:

```php
PaystackServices::payments()  // enables all payment services
PaystackServices::transfers() // enables all transfer services
```

## Webhook Handling

### Endpoint

The package registers a webhook route automatically:

```
POST /paystack/webhook
```

Incoming requests are validated against the `X-Paystack-Signature` header and the caller's IP address (Paystack's published IP whitelist) before any event is dispatched.

### Events

Every valid webhook dispatches `WebhookReceived`. If a specific handler exists on the controller, `WebhookHandled` is also dispatched after it runs.

```php
use Faridibin\PaystackLaravel\Events\WebhookReceived;
use Faridibin\PaystackLaravel\Events\WebhookHandled;

// Fired for every valid webhook
Event::listen(WebhookReceived::class, function (WebhookReceived $event) {
    // $event->event  → WebhookEvent enum case
    // $event->data   → payload array
});

Event::listen(WebhookHandled::class, function (WebhookHandled $event) {
    // fired after a specific handler ran
});
```

### Specific webhook events

The package ships a dedicated event class for every Paystack webhook type:

| Event class                          | Paystack event                    |
| ------------------------------------ | --------------------------------- |
| `ChargeSuccessEvent`                 | `charge.success`                  |
| `ChargeDisputeCreatedEvent`          | `charge.dispute.create`           |
| `ChargeDisputeRemindEvent`           | `charge.dispute.remind`           |
| `ChargeDisputeResolvedEvent`         | `charge.dispute.resolve`          |
| `TransferSucceededEvent`             | `transfer.success`                |
| `TransferFailedEvent`                | `transfer.failed`                 |
| `TransferReversedEvent`              | `transfer.reversed`               |
| `SubscriptionCreatedEvent`           | `subscription.create`             |
| `SubscriptionDisabledEvent`          | `subscription.disable`            |
| `SubscriptionNotRenewedEvent`        | `subscription.not_renew`          |
| `SubscriptionExpiringCardsEvent`     | `subscription.expiring_cards`     |
| `InvoiceCreatedEvent`                | `invoice.create`                  |
| `InvoiceUpdateEvent`                 | `invoice.update`                  |
| `InvoicePaymentFailedEvent`          | `invoice.payment_failed`          |
| `PaymentrequestPendingEvent`         | `paymentrequest.pending`          |
| `PaymentrequestSucceededEvent`       | `paymentrequest.success`          |
| `RefundProcessedEvent`               | `refund.processed`                |
| `RefundPendingEvent`                 | `refund.pending`                  |
| `RefundFailedEvent`                  | `refund.failed`                   |
| `RefundProcessingEvent`              | `refund.processing`               |
| `CustomeridentificationSuccessEvent` | `customeridentification.success`  |
| `CustomeridentificationFailedEvent`  | `customeridentification.failed`   |
| `DedicatedaccountAssignSuccessEvent` | `dedicatedaccount.assign.success` |
| `DedicatedaccountAssignFailedEvent`  | `dedicatedaccount.assign.failed`  |

```php
use Faridibin\PaystackLaravel\Events\ChargeSuccessEvent;

Event::listen(ChargeSuccessEvent::class, function (ChargeSuccessEvent $event) {
    // $event->data — the webhook payload's data array
    $reference = $event->data['reference'];
    // fulfil the order...
});
```

### Custom webhook handling

Extend the webhook controller and add `on<EventName>` methods. The method name is derived by converting the Paystack event to camel case (e.g. `charge.success` → `onChargeSuccess`):

```php
namespace App\Http\Controllers;

use Faridibin\PaystackLaravel\Http\Controllers\WebhookController as BaseWebhookController;
use Symfony\Component\HttpFoundation\Response;

class PaystackWebhookController extends BaseWebhookController
{
    protected function onChargeSuccess(array $data): Response
    {
        // $data is the webhook payload's data array
        // update order status, send receipt, etc.
        return $this->successMethod();
    }

    protected function onTransferSuccess(array $data): Response
    {
        return $this->successMethod();
    }
}
```

Then register the route pointing to your controller in your application's `routes/web.php`:

```php
Route::post('paystack/webhook', [PaystackWebhookController::class, 'handle'])
    ->middleware(\Faridibin\PaystackLaravel\Http\Middleware\ValidateWebhookSignature::class);
```

## Routes

| Method | URI                          | Name                         |
| ------ | ---------------------------- | ---------------------------- |
| `GET`  | `/paystack/transaction/{id}` | `paystack.transaction.fetch` |
| `POST` | `/paystack/webhook`          | `paystack.webhook.handle`    |

Disable all routes:

```php
'routes' => [
    'enabled' => false,
],
```

## Testing

```bash
composer test
```

## License

MIT
