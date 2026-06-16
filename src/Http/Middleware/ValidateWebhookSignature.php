<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Http\Middleware;

use Closure;
use Faridibin\Paystack\Exceptions\PaystackException;
use Faridibin\Paystack\Webhook;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Middleware that validates incoming Paystack webhook requests.
 *
 * Verifies the HMAC-SHA512 signature using the `X-Paystack-Signature` header
 * and checks that the request originates from a Paystack whitelisted IP address.
 *
 * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
 */
class ValidateWebhookSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isMethod('POST') || !$request->hasHeader('X-Paystack-Signature')) {
            throw new AccessDeniedHttpException('Invalid request method or missing signature');
        }

        try {
            Webhook::validateSignature(
                $request->getContent(),
                $request->header('X-Paystack-Signature'),
                config('paystack.secret_key')
            )->isIpWhitelisted($request->ip());
        } catch (PaystackException $exception) {
            throw new AccessDeniedHttpException($exception->getMessage(), $exception);
        }

        return $next($request);
    }
}
