<?php

namespace Faridibin\PaystackLaravel\Http\Middleware;

use Closure;
use Faridibin\Paystack\Exceptions\PaystackException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ValidateWebhookSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // WebhookSignature::verifyHeader(
            //     $request->getContent(),
            //     $request->header('Stripe-Signature'),
            //     config('cashier.webhook.secret'),
            //     config('cashier.webhook.tolerance')
            // );
        } catch (PaystackException $exception) {
            throw new AccessDeniedHttpException($exception->getMessage(), $exception);
        }

        return $next($request);
    }
}
