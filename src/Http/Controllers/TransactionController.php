<?php

namespace Faridibin\PaystackLaravel\Http\Controllers;

use Faridibin\Paystack\Exceptions\PaystackException;
use Faridibin\PaystackLaravel\Facades\Paystack;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Fetch a transaction.
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return void
     */
    public function fetch(Request $request, int $id): JsonResponse|View
    {
        $response = Paystack::transactions()->fetch($id);

        if (!$response->getStatus()) {
            throw new PaystackException('Transaction not found');
        }

        $transaction = $response->getData()->toArray();

        if ($request->expectsJson()) {
            return response()->json($transaction);
        }

        return view('transactions.show', compact('transaction'));
    }
}
