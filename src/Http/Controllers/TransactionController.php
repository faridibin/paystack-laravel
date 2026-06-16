<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Http\Controllers;

use Faridibin\Paystack\Exceptions\PaystackException;
use Faridibin\PaystackLaravel\Facades\Paystack;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Handles Paystack transaction display requests.
 *
 * Fetches a transaction by ID and returns either a JSON response or a view.
 */
class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $middleware = config('paystack.routes.middleware');

        $this->middleware($middleware['transaction.fetch'] ?? ['web']);
    }

    /**
     * Fetch a transaction.
     *
     * @param Request $request
     * @param string $id
     *
     * @return JsonResponse|View
     */
    public function fetch(Request $request, string $id): JsonResponse|View
    {
        $response = Paystack::transactions()->fetch($id);

        if (!$response->getStatus()) {
            throw new PaystackException('Transaction not found');
        }

        $transaction = $response->getData();

        if ($request->expectsJson()) {
            return response()->json($transaction->toArray());
        }

        return view('paystack::transactions.show', [
            'transaction' => $transaction->asObject(),
        ]);
    }
}
