<?php

use Faridibin\PaystackLaravel\Http\Controllers\{WebhookController, TransactionController};
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'paystack',
    'as' => 'paystack.',
], function () {
    Route::get('transaction/{id}', [TransactionController::class, 'fetch'])->name('transaction.fetch');
    Route::post('webhook', [WebhookController::class, 'handle'])->name('webhook.handle');
});
