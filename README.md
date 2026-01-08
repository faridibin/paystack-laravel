# Paystack Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/faridibin/paystack-laravel.svg?style=flat-square)](https://packagist.org/packages/faridibin/paystack-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/faridibin/paystack-laravel.svg?style=flat-square)](https://packagist.org/packages/faridibin/paystack-laravel)
[![License](https://img.shields.io/packagist/l/faridibin/paystack-laravel.svg?style=flat-square)](https://packagist.org/packages/faridibin/paystack-laravel)

A comprehensive Laravel wrapper for [faridibin/paystack-php](https://github.com/faridibin/paystack-php) with first-class Laravel features including facades, config files, webhook handling, and event dispatching. Provides seamless integration of Paystack payment processing in Laravel applications.

## Features

-   🚀 **Laravel Integration** - Native Laravel service provider with auto-discovery
-   🎭 **Facade Support** - Clean, expressive API using Laravel facades
-   ⚙️ **Configuration Management** - Publishable config files with environment variable support
-   🔗 **Webhook Handling** - Built-in webhook controller with signature validation
-   📡 **Event System** - Laravel events for all webhook activities
-   🛡️ **Security** - Automatic webhook signature validation middleware
-   🎯 **Service Selection** - Enable only the Paystack services you need
-   🧪 **Testing Ready** - Comprehensive test suite with Pest PHP

## Installation

You can install the package via Composer:

```bash
composer require faridibin/paystack-laravel
```

### Laravel Auto-Discovery

The package will automatically register itself with Laravel's service container. No manual registration required!

### Publish Configuration

Publish the configuration file to customize the package settings:

```bash
php artisan vendor:publish --tag=paystack-config
```

This will create a `config/paystack.php` file in your application.

### Publish Views (Optional)

If you want to customize the transaction views:

```bash
php artisan vendor:publish --provider="Faridibin\PaystackLaravel\PaystackServiceProvider"
```

## Configuration

### Environment Variables

Add your Paystack credentials to your `.env` file:

```env
PAYSTACK_SECRET_KEY=sk_test_your_secret_key_here
PAYSTACK_CURRENCY=NGN
```

### Service Configuration

The package allows you to enable only the Paystack services you need. Edit `config/paystack.php`:

```php
'services' => [
    PaystackServices::commerce([
        'products' => true,
        'paymentPages' => true,
    ]),
    PaystackServices::payments([
        'transactions' => true,
        'customers' => true,
        'refunds' => true,
        // ... other payment services
    ]),
    PaystackServices::recurring([
        'plans' => true,
        'subscriptions' => true,
    ]),
    PaystackServices::transfers([
        'transfers' => true,
        'recipients' => true,
        'control' => true,
    ]),
    PaystackServices::integration(),
    PaystackServices::verification(),
    PaystackServices::miscellaneous(),
],
```

## Usage

### Using the Facade

The package provides a convenient facade for accessing Paystack services:

```php
use Faridibin\PaystackLaravel\Facades\Paystack;

// Initialize a transaction
$transaction = Paystack::transactions()->initialize('customer@example.com', 50000,[
    'currency' => 'NGN',
]);

// Verify a transaction
$verification = Paystack::transactions()->verify('transaction_reference');

// Create a customer
$customer = Paystack::customers()->create([
    'email' => 'customer@example.com',
    'first_name' => 'John',
    'last_name' => 'Doe',
]);

// Create a plan
$plan = Paystack::plans()->create([
    'name' => 'Monthly Subscription',
    'amount' => 10000, // ₦100.00
    'interval' => 'monthly',
]);
```

### Available Services

The facade provides access to all Paystack services:

#### Commerce Services

-   `Paystack::products()` - Product management
-   `Paystack::paymentPages()` - Payment page management

#### Payment Services

-   `Paystack::transactions()` - Transaction management
-   `Paystack::customers()` - Customer management
-   `Paystack::splits()` - Transaction splits
-   `Paystack::charge()` - Direct charges
-   `Paystack::refunds()` - Refund management
-   `Paystack::disputes()` - Dispute handling
-   `Paystack::settlements()` - Settlement information
-   `Paystack::subaccounts()` - Subaccount management
-   `Paystack::bulkCharges()` - Bulk charging
-   `Paystack::paymentRequests()` - Payment requests
-   `Paystack::terminal()` - Terminal management
-   `Paystack::applepay()` - Apple Pay integration

#### Recurring Services

-   `Paystack::plans()` - Subscription plans
-   `Paystack::subscriptions()` - Subscription management

#### Transfer Services

-   `Paystack::transfers()` - Transfer management
-   `Paystack::recipients()` - Transfer recipients
-   `Paystack::control()` - Transfer controls

#### Other Services

-   `Paystack::integration()` - Integration utilities
-   `Paystack::verification()` - Identity verification
-   `Paystack::miscellaneous()` - Miscellaneous utilities

## Webhook Handling

The package provides built-in webhook handling with automatic signature validation.

### Webhook Endpoint

The package automatically registers a webhook endpoint at:

```
POST /paystack/webhook
```

### Webhook Events

All webhook events are automatically dispatched as Laravel events:

```php
use Faridibin\PaystackLaravel\Events\WebhookReceived;
use Faridibin\PaystackLaravel\Events\WebhookHandled;

// Listen for any webhook
Event::listen(WebhookReceived::class, function (WebhookReceived $event) {
    // $event->event - The webhook event type
    // $event->data - The webhook payload
});

// Listen for successful webhook processing
Event::listen(WebhookHandled::class, function (WebhookHandled $event) {
    // Webhook was successfully processed
});
```

### Specific Webhook Events

The package also dispatches specific events for each webhook type:

```php
use Faridibin\PaystackLaravel\Events\ChargeSuccessEvent;
use Faridibin\PaystackLaravel\Events\SubscriptionCreatedEvent;

Event::listen(ChargeSuccessEvent::class, function (ChargeSuccessEvent $event) {
    // Handle successful charge
});

Event::listen(SubscriptionCreatedEvent::class, function (SubscriptionCreatedEvent $event) {
    // Handle new subscription
});
```

### Custom Webhook Handling

You can extend the webhook controller to add custom handling:

```php
<?php

namespace App\Http\Controllers;

use Faridibin\PaystackLaravel\Http\Controllers\WebhookController as BaseWebhookController;
use Symfony\Component\HttpFoundation\Response;

class PaystackWebhookController extends BaseWebhookController
{
    /**
     * Handle charge.success webhook
     */
    protected function onChargeSuccess(array $data): Response
    {
        // Custom logic for successful charges
        $transaction = $data['data'];

        // Update your database, send notifications, etc.

        return $this->successMethod();
    }

    /**
     * Handle subscription.create webhook
     */
    protected function onSubscriptionCreate(array $data): Response
    {
        // Custom logic for new subscriptions
        $subscription = $data['data'];

        return $this->successMethod();
    }
}
```

Then update your route to use your custom controller:

```php
Route::post('paystack/webhook', [PaystackWebhookController::class, 'handle']);
```

## Routes

The package provides these routes by default:

-   `GET /paystack/transaction/{id}` - Fetch transaction details
-   `POST /paystack/webhook` - Handle Paystack webhooks

You can disable routes in the config:

```php
'routes' => [
    'enabled' => false, // Disable all routes
],
```

## Middleware

### Webhook Signature Validation

The package includes middleware to validate webhook signatures automatically:

```php
'routes' => [
    'middleware' => [
        'webhook.handle' => [
            ValidateWebhookSignature::class
        ]
    ]
],
```

## Testing

Run the test suite:

```bash
composer test
```

The package includes comprehensive tests using Pest PHP.

## Security

If you discover any security-related issues, please email [faridibin@gmail.com](mailto:faridibin@gmail.com) instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Farid Adam](https://github.com/faridibin)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Support

-   📧 Email: [faridibin@gmail.com](mailto:faridibin@gmail.com)
-   🌐 Website: [https://faridibin.tech](https://faridibin.tech)
-   📖 Documentation: [Paystack API Documentation](https://paystack.com/docs/api/)

---

Built with ❤️ for the Laravel community
